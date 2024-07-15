<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="/css/certificatons.css">
    @endsection
<body>
    @include('components.header')

    <div class="bg">
        <h1 class="right">
            Project Management Certifications
        </h1>
    </div>
    <section>
        <span>
            <a href="/">Home</a> / <a href="#">All Certifications</a> / Project Management Certifications
        </span>
        <div class="holder"> 
            <nav>
                <h3>Browse Certifications</h3>
                <ul>
                    @foreach ($certifications as $certification)
                        
                    @endforeach
                    <li>
                        <a href="?certification={{$certification->id}}">{{$certification->name}}</a>
                    </li>
                </ul>
            </nav>
            <div class="holder-boxes">
                @if (request()->certification)
                {{$certification}}
                    <h3>{{$certification->name}}</h3>
                    <div class="boxes">
                        <div class="box">
                            <h4>                {{$certification->name}}</h4>
                            <p>Project management isn't just for construction engineers and military logistics experts anymore. Today, in addition to the regular duties of your job, you are often expected to take on extra assignments and to get that additional job done well, done under budget, and done on time. This E-Course and Certification is not intended to take you from a supervisory or administrative position to that of a project manager. However, the Associate in Project Management (APM)® Certification will ...                        </p>
                            <div class="d-flex">
                                <img src="https://gaqm.org/uploads/cert_logos/logo_2907.png" alt="">
                                <a href="#">
                                    <i class="fa-solid fa-square-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    </div> 
                @endif
            </div>
        </div>
    </section>



        @extends('components.footer')


        <script src="../js/main.js"></script>
</body>
</html>





    



