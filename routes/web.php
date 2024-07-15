<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Use Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;



// User Model
use App\Models\User;
use App\Models\ShortCourse;
use App\Models\LongCourse;
use App\Models\Form;

// use PhpOffice\PhpWord\IOFactory;

// use aspose\slides\Presentation;

// use aspose\slides\SaveFormat;

// use function Laravel\Prompts\text;

use PHPPresentation\Layout;
use PHPPresentation\Shape\Shape;
use PHPPresentation\Slide;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Presentation; // Add this line


// Auth Routes
Route::group(['middleware' => ['auth']], function () {

    // Member Routes
    Route::get('/me', function () {
        return view('me.me');
    });
    Route::get('/my_forms',function () {
        return view('me.forms');
    });
    Route::get('/my_short_courses',function () {
        return view('me.shortCourses');
    });
    Route::get('/my_long_courses',function () {
        return view('me.longCourses');
    });
    Route::get('/change-password',function () {
        return view('me.changePassword',[
            'msg' => ' '
        ]);
    });
    Route::post('/change-passwrod',function () {
        $user = Auth::user();

        $user_password = $user->password; 


        $current_password = request('current_password');
        $new_password = request('new_password');
        $confirm_password = request('confirm_password');

        // Check
        if (password_verify($current_password, $user_password)) {
            return view('me.changePassword',[
                'msg' => 'The Current Password Was Incorrect !'
            ]);
        } else {
            if ($new_password != $confirm_password) {
                return view('me.changePassword',[
                    'msg' => "The New Password Does't Match !"
                ]);
            } else {
                $user->password = bcrypt($new_password);
                $user->save();
                return view('me.changePassword',[
                    'msg' => 'The Password Was Changed Successfully !'
                ]);
            }
        }
    });
    Route::get('/be-member',function () {
        $user = Auth::user();
        if ($user->role == 'member') {

            $endDate = Carbon\Carbon::parse($user->role_start_date)->addYear();
            $remainingMonths = abs($endDate->diffInMonths($user->role_start_date)); // Use the stored start date

            return view('me.member',[
                'remainingMonths' => $remainingMonths,
                'endDate' => $endDate,
            ]);

        }
        return view('me.member');
    });
    Route::post('/beMember',function () {
        $user = User::find(Auth::user()->id)->first();
        $user->role = 'member';
        $user->role_start_date = now(); 
        $user->save();

        $endDate = Carbon\Carbon::parse($user->role_start_date)->addYear();
        $remainingMonths = abs($endDate->diffInMonths($user->role_start_date)); // Use the stored start date

        return redirect('/be-member');
    });

    Route::get('/log-out', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    });


    // Certifcate
    // Short
    Route::get('/get-certifcate/s/{courseId}' ,function ($courseId) {
        $user = Auth::user();
        $short_courses = json_decode(Auth::user()->short_courses);
        $index = 
        array_search($courseId, array_column($short_courses, 'id'));

        if ($index == '') {
            return "<a href='/view/s/$courseId' >You Must View The Course First From This Link </a>";
        } else {
            $specif_course = $short_courses[$index];

            // 1. Get Student Data
            $studentName = $user->username; // Replace with actual student name retrieval

            // 2. Image Manipulation
            $certificatePath = public_path('certificate/certificate_template_short.jpg'); // Path to your template
            $fontPath = public_path('fonts/Segoe UI Bold.woff'); // Path to your font file

            $image = imagecreatefromjpeg($certificatePath);

        
            $textColor = imagecolorallocate($image,253,1,0); // Red text color
            $fontSize = 50;

            // Get the coordinates of the name placeholder (adjust these values)
            $y = 420;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $studentName)[2] - imagettfbbox($fontSize, 0, $fontPath, $studentName)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            // Write the student's name on the certificate
            imagettftext($image, $fontSize, 0, $centeredx, $y, $textColor, $fontPath, $studentName);



            // Get The Course Name
            $course_name = $specif_course->name;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $course_name)[2] - imagettfbbox($fontSize, 0, $fontPath, $course_name)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            imagettftext($image, $fontSize, 0, $centeredx, 600, $textColor, $fontPath, $course_name);


            // Get The Date
            $date = date('d/m/Y');

            imagettftext($image, 20, 0, 880, 725, $textColor, $fontPath, $date);


            // Get The Website Name
            $web_name = strtoupper('QIC ACADEMY'); 
            $fontSize = 38;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $web_name)[2] - imagettfbbox($fontSize, 0, $fontPath, $web_name)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            $color = imagecolorallocate($image,0,0,0);

            imagettftext($image, $fontSize, 0, $centeredx, 840, $color, $fontPath, $web_name);

            // التوقيع
            $signature = 'QIC ACADEMY';
            $fontPath = public_path('fonts/Southam Demo.otf');
            $fontSize = 30;

            imagettftext($image, $fontSize, 0, 215, 710, $textColor, $fontPath, $signature);

            // 3. Save the Modified Certificate

            // Make Dir With This Name
            $dir = public_path("certificate/short/$user->username");
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $modifiedCertificatePath = public_path("certificate/short/$user->username/$user->username.jpeg");
            imagejpeg($image, $modifiedCertificatePath);
            imagedestroy($image);

    
            return view('certificateView',[
                'specif' => $specif_course,
                'imageSrc' => "/certificate/short/$user->username/$user->username.jpeg",
            ]);
        }
        
    });
    // Long
    Route::get('/get-certifcate/l/{courseId}' ,function ($courseId) {
        $long_courses = json_decode(Auth::user()->long_courses);
        $index = array_search($courseId, array_column($long_courses, 'id'));



        if ($index == '') {
            return "<a href='/view/l/$courseId' >You Must View The Course First From This Link </a>";
        } else {
            $specif_course = $long_courses[$index];
            $user = Auth::user();
            // 1. Get Student Data
            $studentName = $user->username; // Replace with actual student name retrieval

            // 2. Image Manipulation
            $certificatePath = public_path('certificate/certificate_template_long.jpg'); // Path to your template
            $fontPath = public_path('fonts/Segoe UI Bold.woff');

            $image = imagecreatefromjpeg($certificatePath);

        
            $textColor = imagecolorallocate($image,253,1,0); // Red text color
            $fontSize = 30;

            // Get the coordinates of the name placeholder (adjust these values)
            $y = 500;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $studentName)[2] - imagettfbbox($fontSize, 0, $fontPath, $studentName)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            // Write the student's name on the certificate
            imagettftext($image, $fontSize, 0, $centeredx, $y, $textColor, $fontPath, $studentName);



            // Get The Course Name
            $course_name = $specif_course->name;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $course_name)[2] - imagettfbbox($fontSize, 0, $fontPath, $course_name)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            imagettftext($image, $fontSize, 0, $centeredx, 360, $textColor, $fontPath, $course_name);


            // Get The Date
            $date = date('d/m/Y');

            imagettftext($image, 20, 0, 700, 617, $textColor, $fontPath, $date);


            // Get The Website Name
            $web_name = strtoupper('QIC ACADEMY'); 
            $fontSize = 35;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $web_name)[2] - imagettfbbox($fontSize, 0, $fontPath, $web_name)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            $color = imagecolorallocate($image,0,0,0);

            imagettftext($image, $fontSize, 0, $centeredx, 885, $color, $fontPath, $web_name);

            // التوقيع
            $signature = 'QIC ACADEMY';

            $fontSize = 30;

            // Calculate text width
            $textWidth = imagettfbbox($fontSize, 0, $fontPath, $signature)[2] - imagettfbbox($fontSize, 0, $fontPath, $signature)[0];

            // Calculate centered x-coordinate
            $centeredx = (imagesx($image) - $textWidth) / 2;

            $fontPath = public_path('fonts/Southam Demo.otf');

            imagettftext($image, $fontSize, 0, $centeredx, 730, $textColor, $fontPath, $signature);

            // 3. Save the Modified Certificate

            // Make Dir With This Name
            $dir = public_path("certificate/long/$user->username");
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $modifiedCertificatePath = public_path("certificate/long/$user->username/$user->username.jpeg");
            imagejpeg($image, $modifiedCertificatePath);
            imagedestroy($image);

    
            return view('certificateView',[
                'specif' => $specif_course,
                'imageSrc' => "/certificate/long/$user->username/$user->username.jpeg",
            ]);
        }
    });

    // Buy This
    Route::get('/certificate/buy-{courseId}',function ($courseId) {


        $short_courses = json_decode(Auth::user()->short_courses);
        $index = 
        array_search($courseId, array_column($short_courses, 'id'));

        $specif_course = $short_courses[$index];

        $specif_course->certificate = true;

        Auth::user()->short_courses = $short_courses;

        Auth::user()->save();


        return redirect("/get-certifcate/s/$courseId");


    });

    // Exam 
    Route::get('/exam/{courseId}',function ($courseId) {
        
        // $course = LongCourse::find($courseId);
        $course = LongCourse::find($courseId);

        return view("exam",[
            'course' => $course,
        ]);

    });


    Route::post('/exam/{courseId}',function ($courseId) {

        $course = LongCourse::find($courseId);
        $currentIndex = request('currentIndex');
        $lastIndex = count(json_decode($course->quiz));
        
        $quiz = json_decode($course->quiz)[$currentIndex] ?? null;
        
        // Get User
        $user = Auth::user();
        $long_courses = json_decode($user->long_courses);
        $index = array_search(9, array_column($long_courses, 'id'));

        $degree = $long_courses[$index]->exam->degree;



        if ($currentIndex == 0) {
            $degree = 0;
            $long_courses[$index]->exam->degree = $degree;

            $user->long_courses = json_encode($long_courses);
            $user->save();
        }
        

        // Return Response Object
        $response = new \stdClass();

        // Set The Q And Answers
        if ($quiz == null) {
            $myIndex = $currentIndex - 1; // Use the current index
            $new_quiz = json_decode($course->quiz)[$myIndex];

            $answer = request("question_$myIndex");

            $correct = $new_quiz->correct;
 
            $response->correct = $correct;
            $response->answer = $answer;

            if ($correct == $answer) {
                // Check The Answer
                $response->message = "Correct Answer";
                $response->class = 'green';

                $new_degree = $degree + 1;
                $long_courses[$index]->exam->degree = $new_degree;

                $user->long_courses = json_encode($long_courses);
                $user->save();

                // Get Degree
                $response->degree = ($new_degree  * 100) / (count(json_decode($course->quiz)) );

            } else {
                // Check The Answer
                $response->message = "False Answer";
                $response->class = 'red';
                // Get Degree
                $new_degree = $degree;
                $response->degree = ($new_degree * 100) / (count(json_decode($course->quiz)) );
            }


            $response->status = false;

            if ($course->success_degree <= ($new_degree * 100) / (count(json_decode($course->quiz)) )) {
                $long_courses[$index]->exam->solved = true;

                $user->long_courses = json_encode($long_courses);
                $user->save();
            } else {
                $long_courses[$index]->exam->solved = false;
                $user->long_courses = json_encode($long_courses);
                $user->save();

            }

        } else {
            $response->question = $quiz->question;
            $answers = $quiz->answers;
            shuffle($answers);
            $response->answers = $answers;
            $response->status = true;

            // Check the answer for all questions, including the first
            if ($currentIndex > 0) {
                $myIndex = $currentIndex - 1; // Use the current index
                $new_quiz = json_decode($course->quiz)[$myIndex];

                $answer = request("question_$myIndex");

                $correct = $new_quiz->correct;


                if ($correct == $answer) {
                    // Check The Answer
                    $response->message = "Correct Answer";
                    $response->class = 'green';

                    $new_degree = $degree + 1;
                    $long_courses[$index]->exam->degree = $new_degree;

                    $user->long_courses = json_encode($long_courses);
                    $user->save();

                } else {
                    // Check The Answer
                    $response->message = "False Answer";
                    $response->class = 'red';
                }
            }
        }

        return $response;
          
    });


    // Save The Course History

    Route::get('/view/s/{courseid}',function ($courseid) {
        $user = Auth::user();
        $course = ShortCourse::find($courseid);
        $short_courses = json_decode($user->short_courses);

        $courses = array_filter($short_courses, function ($item) use ($courseid) {
            return $item->id == $courseid;
        });

        if (count($courses) < 0) {
            $add = ['name' => $course->name,"id" => $course->id , 'certificate_price' => $course->certificate_price ,'certificate' => FALSE , 'exam' => 'not_have'];

            array_push($short_courses,$add);
    
            $user->short_courses = json_encode($short_courses);
    
            $user->save();
        }

        return view('file_view' , [
            'path' => $course->path,
            'paths' => false,
            'course' => $course
        ]);
    });

    Route::get('/view/l/{courseid}',function ($courseid) {
        $user = Auth::user();
        $course = LongCourse::find($courseid);
        $long_courses = json_decode($user->long_courses);


        $courses = array_filter($long_courses, function ($item) use ($courseid) {
            return $item->id == $courseid;
        });

        if (count($courses) == 0) {
            $add = ['name' => $course->name,"id" => $course->id , 'certificate_price' => $course->certificate_price,'completed' => 0, 'exam' => ["solved" => false, "degree" => 0],];
            array_push($long_courses,$add);
    
            $user->long_courses = json_encode($long_courses);
            $user->save();
        }

        // Get The Paths
        $files = json_decode($course->paths);
        $file = $files[request('file')];

        if (request('file') + 1 != count($files)) {

            $files[request('file') + 1]->completed = true;
    
            $course->paths = json_encode($files);
    
            $course->save();
        }

        


        return view('file_view', [ 
            'file' => $file,
            'path' => false,
            'course' => $course
        ]);
    });

    Route::get('/buy-form/{courseid}',function ($courseid) {

        
        $user = Auth::user();
        $course = Form::find($courseid);

        // Get All The Files From Its Paths With All Extenstions
        $files = glob('uploads/forms/' . $course->name . '/*', GLOB_MARK);


        // Check If It's Buyed Before
        $forms = json_decode($user->files_buyed);
        $form = array_filter($forms, function ($item) use ($courseid) {
            return $item->id == $courseid;
        });

        if (count($form) > 0) {
            return redirect('/my_forms');
        }

        $add = ['name' => $course->name,"id" => $course->id , 'price' => $course->price, 'path' => $files[0]];
    

        array_push($forms,$add);

        $user->files_buyed = json_encode($forms);

        $user->save();

        return redirect('/my_forms');



    });



    // Dashboard Routes
    // if (Auth::user()->role == 'admin') {
        Route::get('/dashboard', function () {
            return redirect('/dashboard/users');
        });
        Route::get('/dashboard/users', function (Request $req) {

            if ($req->has('edit-user')) {
                $user = User::find($req->edit_user);
                return view('admin.users', [
                    'users' => User::all(),
                    'user' => $user,
                ]);
            }

            return view('admin.users', [
                'users' => User::all(),
            ]);
        });
        
        Route::get('/dashboard/files', function () {

            if (request()->has('edit-file')) {
                $form = Form::find(request()->edit_file);
                return view('admin.forms', [
                    'forms' => Form::all(),
                    'form' => $form,
                ]);
            }


            return view('admin.forms', [
                'forms' => Form::all(),
            ]);
        });

        Route::get('/dashboard/short_courses', function () {
            if (request()->has('edit-scourse')) {
                $scourse = ShortCourse::find(request()->edit_scourse);
                return view('admin.shortCourses', [
                    'courses' => ShortCourse::all(),
                    'course' => $scourse,
                ]);

            }
            return view('admin.shortCourses',
            [
            'courses' => ShortCourse::all(),
            ]);
        });

        Route::get('/dashboard/long_courses', function () {
            
            if (request()->has('edit-lcourse')) {
                $lcourse = LongCourse::find(request()->edit_lcourse);
                return view('admin.longCourses', [
                    'courses' => LongCourse::all(),
                    'course' => $lcourse,
                ]);

            }  

            return view('admin.longCourses', [
                'courses' => LongCourse::all(),
            ]);
        });


        // Edit System

        // Edit User
        Route::post('/edit-user-{id}',function ($id) {

            $user = User::find($id);
            $user->full_name = request('full_name');
            $user->gender = request('gender');
            if (request('role')) {
                $user->role = request('role');
            }
            if (request('username')) {
                $user->username = request('username');
            }
            $user->date = request('date');
            $user->email = request('email');
            $user->phone = request('phone');
            $user->street_1 = request('street_1');
            $user->street_2 = request('street_2');
            $user->city = request('city');
            $user->zip = request('zip');
            $user->state = request('state');
            $user->country = request('country');
            $user->save();

            return redirect()->back();
        });

        // Remove User
        Route::get('/remove-user-{id}',function ($id) {
            $user = User::find($id);
            $user->delete();
            return redirect('/dashboard/users');
        });

        // Edit File
        Route::post('/edit-file-{id}', function ($id) {
            $form = Form::find($id);
        
            // Update form details
            $form->name = request()->name;
            $form->price = request()->price;
        
            // File Handling
            if (request()->hasFile('path')) { // Check if a new file is uploaded
                $file = request()->file('path');
                $fileName = $file->getClientOriginalName();
        
                // Delete the old file
                $oldFilePath = public_path('uploads/forms/' . $form->name);
                if (file_exists($oldFilePath)) {
                    $myfiles = glob($oldFilePath . '/*', GLOB_MARK);
                    foreach ($myfiles as $myfile) {
                        unlink($myfile);
                    }
                    rmdir($oldFilePath);
                }
        
                // Create the folder if it doesn't exist
                $folderPath = public_path('uploads/forms/' . $form->name);
                if (!is_dir($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                // Move the new file
                $file->move($folderPath, $fileName);
        
                // Update the path in the database
                $form->path = 'uploads/forms/' . $form->name . "/$fileName";
            }
        
            $form->save();
        
            return redirect('/dashboard/files');
        });       

        // Remove File
        Route::get('/remove-file-{id}',function ($id) {
            $file = Form::find($id);

            $oldFilePath = public_path('uploads/forms/' . $file->name);
            if (file_exists($oldFilePath)) {
                $myfiles = glob($oldFilePath . '/*', GLOB_MARK);
                foreach ($myfiles as $myfile) {
                    unlink($myfile);
                }
                rmdir($oldFilePath);
            }
            $file->delete();
            return redirect('/dashboard/files');
        });

        // Edit Short Course
        Route::post('/edit-scourse-{id}', function ($id) {
            $scourse = ShortCourse::find($id);
        
            // Update course details
            $scourse->name = request()->name;
            $scourse->certificate_price = request()->certificate_price;
        
            // File Handling
            if (request()->hasFile('path')) { // Check if a new file is uploaded
                $file = request()->file('path');
                $fileName = $file->getClientOriginalName();
        
                // Delete the old file
                $oldFilePath = public_path('uploads/short_courses/' . $scourse->name);
                if (file_exists($oldFilePath)) {
                    $myfiles = glob($oldFilePath . '/*', GLOB_MARK);
                    foreach ($myfiles as $myfile) {
                        unlink($myfile);
                    }
                    rmdir($oldFilePath);
                }
        
                // Create the folder if it doesn't exist
                $folderPath = public_path('uploads/short_courses/' . $scourse->name);
                if (!is_dir($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }
        
                // Move the new file
                $file->move($folderPath, $fileName);
        
                // Update the path in the database
                $scourse->path = 'uploads/short_courses/' . $scourse->name . "/$fileName";
            }
        
            $scourse->save();
        
            return redirect('/dashboard/short_courses');
        });
        
        // Remove Short Course
        Route::get('/remove-scourse-{id}',function ($id) {
            $scourse = ShortCourse::find($id);


            // Delete the old file
            $oldFilePath = public_path('uploads/short_courses/' . $scourse->name);
            if (file_exists($oldFilePath)) {
                $myfiles = glob($oldFilePath . '/*', GLOB_MARK);
                foreach ($myfiles as $myfile) {
                    unlink($myfile);
                }
                rmdir($oldFilePath);
            }
        
            $scourse->delete();
            return redirect('/dashboard/short_courses');
        });
        
        // Edit Long Course
        Route::post('/edit-lcourse-{id}', function ($id , Request $request) {
            $lcourse = LongCourse::find($id);
        
            // Update course details
            $lcourse->name = $request->name;
            $lcourse->certificate_price = $request->price;
            $lcourse->success_degree = $request->success_degree;

            // Start Quiz

            $index = request()->index;
            $questions = [];
            // Loop
            for ($i = 0; $i < $index ; $i++) {
        
                $answersArray = request()["answers_$i"] ;
        
                $answersArray[] = request()["correct_answer_$i"];
        
                // Question
                $questions[] = [
                    "question" => request()["question_$i"],
                    "answers" => $answersArray,
                    "correct" => request()["correct_answer_$i"]
                ];
            }
        
            $lcourse->quiz = json_encode($questions);

            // End Quiz
        
            // File Handling
            if ($request->hasFile('many_paths')) { // Check if new files are uploaded

                $files = $request->file('many_paths');

                // Delete old files
                $oldFilePath = public_path('uploads/long_courses/' . $lcourse->name);

                if (file_exists($oldFilePath)) {
                    $myfiles = glob($oldFilePath . '/*', GLOB_MARK);
                    foreach ($myfiles as $myfile) {
                        unlink($myfile);
                    }
                    rmdir($oldFilePath);
                }
        
                // Create the folder if it doesn't exist
                $folderPath = public_path('uploads/long_courses/' . $lcourse->name);
                if (!is_dir($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }
        
                // Move new files
                $newPaths = [];
                foreach ($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $file->move($folderPath, $fileName);
                    $newPaths[] = 'uploads/long_courses/' . $lcourse->name . "/$fileName";
                }
        
                // Update the paths in the database
                $lcourse->paths = json_encode($newPaths);
            }
        
            $lcourse->save();
        
            return redirect('/dashboard/long_courses');
        });
        
        // Remove Long Course
        Route::get('/remove-lcourse-{id}',function ($id) {
            $lcourse = LongCourse::find($id);


            // Delete the old file
            $oldFilePath = public_path('uploads/long_courses/' . $lcourse->name);
            if (file_exists($oldFilePath)) {
                $myfiles = glob($oldFilePath . '/*', GLOB_MARK);
                foreach ($myfiles as $myfile) {
                    unlink($myfile);
                }
                rmdir($oldFilePath);
            }

            $lcourse->delete();
            return redirect('/dashboard/long_courses');
        });



        // Save System
        Route::post('/new-short-course',function () {
            $short_course = new ShortCourse() ;
            $short_course->name = request('name');
            $short_course->certificate_price = request('certificate_price');


            // Paths
            $file = request()->file('path'); // Get uploaded files
        
            // Create the folder
            $folderPath = public_path('uploads/short_courses/' . request('name')); 
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); 
            }
        
            // Move the files
            $fileName = $file->getClientOriginalName();
            $short_course->path = 'uploads/short_courses/' . request('name') . "/$fileName";

            // Move the file
            $file->move($folderPath, $fileName);

            $short_course->save();
            return redirect('/dashboard/short_courses');

        });

        Route::post('/new-long-course',function (Request $request) {
            $long_course = new LongCourse() ;
            $long_course->name = $request->input('name');
            $long_course->certificate_price = $request->input('certificate_price');
        
            // Paths
            $files =  $request->file('many_paths');
            $paths = json_decode($long_course->paths);

            // Create the folder
            $folderPath = public_path('uploads/long_courses/' . request('name')); 
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); 
            }
        
            // Move the files
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();   
                // Add To Paths Array
                $paths[] =  [
                    'completed' => false,
                    'path' => 'uploads/long_courses/' . request('name') . "/$fileName",
                ];      
                $file->move($folderPath, $fileName);
            }
        
            $long_course->paths = json_encode($paths);

            // Start Quiz
            $index = request()->index;
            $questions = [];
            // Loop
            for ($i = 0; $i < $index ; $i++) {
        
                $answersArray = request()["answers_$i"] ;
        
                $answersArray[] = request()["correct_answer_$i"];
        
                // Question
                $questions[] = [
                    "question" => request()["question_$i"],
                    "answers" => $answersArray,
                    "correct" => request()["correct_answer_$i"]
                ];
            }

            $long_course->quiz = json_encode($questions);
            // $long_course->duration = request()->duration;

            // End Quiz

            $long_course->success_degree = request('success_degree');
            $long_course->save();
            return redirect('/dashboard/long_courses');
        });

        Route::post('/new-file',function () {
            $form = new Form() ;
            $form->name = request('name');
            $form->price = request('price');

            // Paths
            $file = request()->file('path');

            // Create the folder
            $folderPath = public_path('uploads/forms/' . request('name')); 
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); 
            }
        
            // Move the files
            $fileName = $file->getClientOriginalName();
            $file->move($folderPath, $fileName);


            $form->path = 'uploads/forms/' . $form->name . "/$fileName";


            $form->save();
            return redirect('/dashboard/files');
        });

    // }

});


// Sign Up
Route::post('/save-user', [RegisterController::class , 'register']);

Route::post('/login',[AuthController::class,'login'])->name('login');

// Static Pages
Route::get('/', function () {
    $user = Auth::user();
    if ($user) {
        // Check The Member Subscription
        $end_date = Carbon\Carbon::parse($user->role_start_date)->addYear();
        $now = now();

        // Check If The Subsription is valid
        if ($end_date < $now) {
            $user->role = 'normal';
            $user->save();
        }
        
    }

    $featuredShortCourses = ShortCourse::all()->take(2); // Get the first 2 short courses
    $featuredLongCourses = LongCourse::all()->take(2);  // Get the first 2 long courses
    
    return view('welcome', [
        'featuredShortCourses' => $featuredShortCourses,
        'featuredLongCourses' => $featuredLongCourses,
    ]);

});

Route::get('/certified_registry' ,function () {
    return view('certified_registry');
});


Route::get('/certifications' ,function () {
    if (request()->has('certification')) {
        return view('certifications',
        [
            'certifications' => ShortCourse::all(),
            'certification' => ShortCourse::find(request()->certification),
        ]);

    }
    return view('certifications',
    [
        'certifications' => ShortCourse::all(),
    ]);
});
Route::get('/categories' ,function () {
    if (request()->t == 's') {
        return view('categories', [
            'alldata' => ShortCourse::all(),
        ]);
    } else if (request()->t == 'l') {
        return view('categories', [
            'alldata' => LongCourse::all(),
        ]);
    } else {
        return view('categories', [
            'alldata' => Form::all(),
        ]);
    }

});

Route::get('/about-us', function () {
    return view('about');
});
Route::get('/terms-and-conditions', function () {
    return view('terms');
});
Route::get('/course-methodology', function () {
    return view('methodology');
});

Route::get('/certiication' ,function () {
    $course_id = request()->id;
    if  (request()->t == 's') {
        return view('certiicationView',[
            'course' => ShortCourse::find($course_id),
        ]);
    } else if (request()->t == 'l') {
        $course = LongCourse::find($course_id);
        // Get The Paths
        $files = json_decode($course->paths);
        $files[0]->completed = true;
        $course->paths = json_encode($files);
        $course->save();


        return view('certiicationView',[
            'course' => $course,
            'files' => json_decode($course->paths)
        ]);
    } else {
        return abort(404);
    }
});

Route::get('/contact-us' ,function () {
    return view('contact_us');
});

// Auth Views
Route::get('/forgot_password' ,function () {
    return view('auth.forgot_password');
});

Route::get('/forgot_username' ,function () {
    return view('auth.forgot_username');
});

Route::get('/login' ,function () {
    return view('auth.login');
});

Route::get('/registration' ,function () {
    return view('auth.registration');
});
