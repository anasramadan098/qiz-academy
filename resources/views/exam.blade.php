<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        <link rel="stylesheet" href="{{asset('css/exam.css')}}">
    @endsection
<body>
    <form action="" id="examForm">
        @csrf
        <img src="{{asset('imgs/logo.png')}}" alt="Logo">
        <span class="exam-duration"></span>
        <input type="hidden" name="currentIndex" class="hidden" value="">
        <div class="steps">
            <div class="step active main">
                <h3>Before The Exam</h3>
                <p><b>Sucess Degree: </b> {{$course->success_degree}}%</p>
                <p><b>Resolve The Exam: </b> Yes</p>
                <p><b>Exit From The Exam Without Complete it: </b> No, and you must resolve the exam to get your certificate</p>
                <p class="red">If You Exit From The Exam You Will Start From Begining !</p>
                <p class="red">If You Resolve The Exam Your Degree Will Uptaded To The Last Degree !</p>
                <div class="btns">
                    <a href="#"></a>
                    <button class="btn next start">Start The Exam</button>
                </div>
            </div>
        </div>
        <div class="final-step" style="display: none">
            <h3>End Of The Exam</h3>
            <p>Sucessful Degree Is <span class="sucess-degree">{{$course->success_degree}}</span>%</p>
            <p><b>Your Degree Is <span class="my-degree"></span>%</b></p>

            <div class="btns">
                <a href="/exam/{{$course->id}}" class="btn">Resolve The Exam</a>
                <a href="/get-certifcate/l/{{$course->id}}" class="btn next">Next</a>
            </div>

        </div>
    </form>

    <script src="{{asset('js/slides.js')}}"></script>
    <script>
        // Connect With Ajax
        document.getElementById('examForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = new FormData(this);

            // AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', location.pathname, true); // Replace with your actual route
            xhr.onload = function() {
                if (this.status >= 200 && this.status < 300) {
                    // Handle successful response
                    let response = JSON.parse(this.responseText);
                    console.log(response.degree)
                    // Create Step
                    let specifStep = response.status;

                    if (specifStep != false) {
                        if (currentIndex > 0) {
                            document.querySelector(`.btns .p-${currentIndex - 1}`).innerHTML = response['message'];
                            document.querySelector(`.btns .p-${currentIndex - 1}`).classList.add(response['class']);
                        }
                        createStep(currentIndex,response.question,response.answers);
                        nextStep()
                    } else {
                        document.querySelector(`.btns .p-${currentIndex - 1}`).innerHTML = response['message'];
                        document.querySelector(`.btns .p-${currentIndex - 1}`).classList.add(response['class']);
                        document.querySelector(`.final-step .my-degree`).innerHTML = response['degree'].toFixed(2);
                        setTimeout(() => {
                            // End Of The Exam
                            document.querySelectorAll('.step')[currentIndex].style.display = 'none';

                            document.querySelector('.final-step').style.display = 'block';
                        }, 1000);

                    }

                } else {
                    // Handle error
                    console.error('Error:', this.status, this.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>