<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="css/single-view.css">
        <style>
        .bg {
                background: url(https://gaqm.org/assets/img/banner/banner3.jpg);
            }
            .disabled {
                cursor: help;
                opacity: .5;
                background: #000;
            }
        </style>
    @endsection
<body>
    @include('components.header')
    <div class="bg">
        <h1 class="right">Globally Certified Professionals</h1>
    </div>
    <section class="info">
        <h2 class="title">Course Information</h2>
        @if  (request()->t == 's') 
            <div class="holders">
                <div class="holder">
                    <div class="head">
                        <h3>Course Name</h3>
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                    <div class="body">
                        {{$course->name}}
                    </div>
                </div>
                <div class="holder">
                    <div class="head">
                        <h3>Certificate Price</h3>
                        <i class="fa-solid fa-arrow-down"></i>
                    </div>
                    <div class="body">
                        Certifcate Price Is {{$course->certificate_price}}$
                    </div>
                </div>
            </div>
            <a href="/get-certifcate/s/{{$course->id}}" class="btn">GET CERTIFICATION</a>
        @else 
            <p style="text-align: center; font-size:20px; margin:20px 0; color:#333;">If you would like to obtain the content in Arabic, Contact to us</p>
            <div class="card">
                <div class="head">
                    <img src="../imgs/logo.png" alt="">
                </div>
                <div class="body">
                    <ul>
                        <li><span>Course Name:</span> {{$course->name}}</li>
                        <li><span>Course Methodology:</span> Self-Learning</li>
                        <li><span>Exam:</span> Yes</li>
                        <li><span>Exam Duration:</span> 60 minutes</li>
                        <li><span>Passing Score:</span> {{$course->success_degree}}%</li>
                        <li><span>Fees: </span> <span class="mr-30"> {{$course->certificate_price}}$ </span> <span>For members: </span>{{$course->certificate_price / 2}}$  </li>
                        <li><span>Re-take the Exam:</span> Free</li>
                        <li><span>Certificate:</span> Yes</li>
                    </ul>
                </div>
            </div>
            <a href="/exam/{{$course->id}}" class="btn sec">GET EXAM</a>
            <a href="/get-certifcate/l/{{$course->id}}" class="btn">GET CERTIFICATION</a>
        @endif
    </section>
    <section class="outline">
        <h2 class="title">Course View</h2>
        @if  (request()->t == 's') 
            <a href="/view/s/{{$course->id}}" class="btn">VIEW COURSE</a>
        @else 
            @forEach ($files as $file)
                @if ($file->completed) 
                    <a href="/view/l/{{$course->id}}?file={{$loop->index}}" class="btn">VIEW COURSE</a>
                @else 
                    <a href="#" class="btn disabled">VIEW PREVIOUS FIRST</a>
                @endif
            @endforEach
        @endif
    </section>


        @extends('components.footer')

        <script src="../js/main.js"></script>
        <script>
            if (document.querySelectorAll('.info .holder')) {
                document.querySelectorAll('.info .holder').forEach(e => {
                    e.addEventListener('click', () => {
                        e.classList.toggle('active')
                    })

                })
            }
        </script>
</body>
</html>