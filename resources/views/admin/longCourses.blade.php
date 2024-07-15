@extends('admin.layout.layout')

@section('active',3)

@section('content')

    <div>
        <h2>Long Courses</h2>
        <div class="boxes">
            <div class="head box">
                <h4>Name</h4>
                <h4>Price</h4>
                <h4>Success Degree</h4>
                <h4>Actions</h4>
            </div>

            @foreach($courses as $course)
                <div class="box">
                    <h4>{{$course->name}}</h4>
                    <p>{{$course->certificate_price}}</p>
                    <p>{{$course->success_degree}}</p>
                    <div class="btns">
                        <a class="btn" href="?edit-lcourse={{$course->id}}">Edit</a>
                        <a class="btn" href="/remove-lcourse-{{$course->id}}">Delete</a>
                    </div>
                </div>
            @endforeach

        </div>

            
    </div>


    @if (request()->has('edit-lcourse'))

        <div>
            <h2>Edit Long Course</h2>
            
            <form action="/edit-lcourse-{{$course->id}}" enctype="multipart/form-data" method="POST">
                @csrf

                <input type="text" required  placeholder="Course Name" name="name" value="{{$course->name}}">
                <input type="number" placeholder="Certificate Price" name="price" value="{{$course->certificate_price}}">
                
                <input type="file" multiple name="many_paths[]" value="{{$course->paths}}">
                
                <input type="number" placeholder="Success Degree" name="success_degree" value="{{$course->success_degree}}">

                <div class="exam">
                    <h2>Exam</h2>
                    <input type="number" placeholder="Duration" name="duration">
                    <div class="inputs">
                        <input type="hidden" value="" name="index" class="hidden">
                    </div>
                    
                    <a class="btn" onclick="createInputDiv()">Add Question</a>
                </div>

                <input type="submit" class="btn" value="Add File">
            </form>
        </div>

    @else

        <div>
            <h2>Add Long Course</h2>
            
            <form action="/new-long-course" enctype="multipart/form-data" method="POST">
            @csrf

                <input type="text" required  placeholder="Course Name" name="name">
                <input type="number" placeholder="Price" name="certificate_price">

                <input type="file" multiple name="many_paths[]">
                
                <input type="number" placeholder="Success Degree" name="success_degree">

                <div class="exam">
                    <h2>Exam</h2>
                    <input type="number" placeholder="Duration" name="duration">
                    <div class="inputs">
                        <input type="hidden" value="" name="index" class="hidden">
                    </div>
                    
                    <a class="btn" onclick="createInputDiv()">Add Question</a>
                </div>
                <input type="submit" class="btn" value="Add File">
            </form>

        </div>
    
    @endif

    <script>
        //  Create Exam input Div
        var exam = document.querySelector('.exam .inputs');
        var btn = document.querySelector('.btn');
        var hiddenInput = document.querySelector('input.hidden');
        var theIndex = 0;

        hiddenInput.value = theIndex;

        function createInputDiv(q = '',a1 = '',a2="",a3="",c = '') {
            var div = document.createElement('div');
            div.classList.add('input');
            var input = document.createElement('input');
            input.type = 'text';
            input.placeholder = 'Question';
            input.name = `question_${theIndex}`;
            input.value = q;
            div.appendChild(input);
            var input = document.createElement('input');
            input.type = 'text';
            input.placeholder = `answer 1`;
            input.value = a1;
            input.name = `answers_${theIndex}[]`;
            div.appendChild(input);
            var input = document.createElement('input');
            input.type = 'text';
            input.placeholder = 'answer 2';
            input.value = a2;
            input.name = `answers_${theIndex}[]`;
            div.appendChild(input);
            var input = document.createElement('input');
            input.type = 'text';
            input.placeholder = 'answer 3';
            input.value = a3;
            input.name = `answers_${theIndex}[]`;
            div.appendChild(input);
            var input = document.createElement('input');
            input.type = 'text';
            input.placeholder = 'correct answer';
            input.name = `correct_answer_${theIndex}`;
            input.value = c;
            div.appendChild(input);

            // Delete Btn
            var btn = document.createElement('a');
            btn.className = 'btn delete'
            btn.innerHTML = 'Delete';
            btn.onclick = function() {
                this.parentElement.remove();
                theIndex--;
                hiddenInput.value = theIndex;
            }
            div.appendChild(btn);

            exam.appendChild(div);
            theIndex++;
            hiddenInput.value = theIndex;
        }
    </script>

    @if (request()->has('edit-lcourse'))
        <script>
            @foreach (json_decode($course->quiz) as $exam)
        
                createInputDiv("{{$exam->question}}",
                "{{$exam->answers[0]}}",
                "{{$exam->answers[1]}}",
                "{{$exam->answers[2]}}",
                "{{$exam->correct}}");
            @endforeach
        </script>
    @endif

@endsection