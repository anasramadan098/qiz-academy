<!DOCTYPE html>
<html lang="en">
    @include('components.head')
<body>
    @include('components.header')

        <!-- Start Welcome -->
        <section class="video">
            <video autoplay muted loop>
                <source src="../imgs/vido.mp4" type="video/mp4">
            </video>
        </section>
        <!-- End Welcome -->
        <!-- Start process -->
        <section class="process">
            <h2 class="title">Our Certification Process</h2>
            <div class="steps">
                <div class="step">
                    <h3>TAKE THE E-COURSE <br>(STUDY UP)</h3>
                    <img src="../imgs/study.png" alt="certified">
                    <p>GAQM Body of Knowledge</p>
                </div>
                <div class="step">
                    <h3>TAKE AN EXAM</h3>
                    <img src="../imgs/exam.png" alt="certified">
                    <p>via ProctorU or <br> Authorised Testing Center</p>
                </div>
                <div class="step">
                    <h3>GET CERTIFIED</h3>
                    <img src="../imgs/certified.png" alt="certified">
                    <p>Earn Certification / Credential</p>
                </div>
            </div>
        </section>
        <!-- End process -->
        <!-- Start Why -->
        <section class="why">
            <h2 class="title">Why GAQM</h2>
            <div class="boxes">
                <div class="box">
                    <h3>GAQM Body of Knowledge</h3>
                    <p>online E-Courses are just a few clicks away.</p>
                    <div class="line"></div>
                    <h4>self paced learning</h4>
                </div>
                <div class="box">
                    <h3>GAQM Body of Knowledge</h3>
                    <p>online E-Courses are just a few clicks away.</p>
                    <div class="line"></div>
                    <h4>self paced learning</h4>
                </div>
                <div class="box">
                    <h3>GAQM Body of Knowledge</h3>
                    <p>online E-Courses are just a few clicks away.</p>
                    <div class="line"></div>
                    <h4>self paced learning</h4>
                </div>
                <div class="box">
                    <h3>GAQM Body of Knowledge</h3>
                    <p>online E-Courses are just a few clicks away.</p>
                    <div class="line"></div>
                    <h4>self paced learning</h4>
                </div>
            </div>
        </section>
        <!-- End Why -->
        <!-- Start Featured -->
        <section class="featured">
            <h2 class="title">Featured Certifications</h2>
            <div class="cards">
                @foreach ($featuredShortCourses as $course)
                    <a href="/certiication?t=s&id={{ $course->id }}">
                        <div class="card">
                            <h3>{{$course->name}}</h3>
                            <i class="fa-solid fa-laptop-file"></i>
                        </div>
                    </a>
                @endforeach
                @foreach ($featuredLongCourses as $course)
                    <a href="/certiication?t=l&id={{ $course->id }}">
                        <div class="card">
                            <h3>{{$course->name}}</h3>
                            <i class="fa-solid fa-laptop-file"></i>
                        </div>
                    </a>
                @endforeach
            </div>
            <a href="#" class="more">View All Certifications <i class="fa-solid fa-angles-right"></i> </a>
            {{-- <h2 class="title">Important Links</h2>
            <div class="boxes">
                <div class="box">
                    <div class="title">
                        <h3>ProctorU Online Testing Services</h3>
                        <p>Take your Exam Anywhere, Anytime</p>
                        <p>Save Time and Money</p>
                    </div>
                    <img src="../imgs/important-links-1.png" alt="Important">
                    <a href="#" class="more">Click Here, To Know More <i class="fa-solid fa-angles-right"></i> </a>
                </div>
                <div class="box">
                    <div class="title">
                        <h3>ProctorU Online Testing Services</h3>
                        <p>Take your Exam Anywhere, Anytime</p>
                        <p>Save Time and Money</p>
                    </div>
                    <img src="../imgs/important-links-1.png" alt="Important">
                    <a href="#" class="more">Click Here, To Know More <i class="fa-solid fa-angles-right"></i> </a>
                </div>
                <div class="box">
                    <div class="title">
                        <h3>ProctorU Online Testing Services</h3>
                        <p>Take your Exam Anywhere, Anytime</p>
                        <p>Save Time and Money</p>
                    </div>
                    <img src="../imgs/important-links-1.png" alt="Important">
                    <a href="#" class="more">Click Here, To Know More <i class="fa-solid fa-angles-right"></i> </a>
                </div>
                <div class="box">
                    <div class="title">
                        <h3>ProctorU Online Testing Services</h3>
                        <p>Take your Exam Anywhere, Anytime</p>
                        <p>Save Time and Money</p>
                    </div>
                    <img src="../imgs/important-links-1.png" alt="Important">
                    <a href="#" class="more">Click Here, To Know More <i class="fa-solid fa-angles-right"></i> </a>
                </div>
            </div> --}}
        </section>
        <!-- End Featured -->
        <!-- Start Corporate -->
        <section class="corporate" id="partners">
            <h2 class="title">Corporate Participants</h2>
            <div class="imgs">
                <a href="#">
                    <img src="../imgs/Logocomp-1.png" alt="Logo Company">
                </a>
                <a href="#">
                    <img src="../imgs/Logocomp-2.png" alt="Logo Company">
                </a>
                <a href="#">
                    <img src="../imgs/Logocomp-3.png" alt="Logo Company">
                </a>
                <a href="#">
                    <img src="../imgs/Logocomp-4.png" alt="Logo Company">
                </a>
                <a href="#">
                    <img src="../imgs/Logocomp-5.png" alt="Logo Company">
                </a>
            </div>
            <a href="#" class="more">View All Global Corporate Participants <i class="fa-solid fa-angles-right"></i></a>
        </section>
        <!-- End Corporate -->
        <!-- Start rates -->
        <section class="testimonials">
            <h2 class="title">Our Testimonials</h2>
            <div class="testimonial">
                <img src="../imgs/testimonial-1.jpg" alt="testimonial"/>
                <div class="text">
                    <p>"GAQM Certifications have really helped me to boost my confidence and increase my current skills to do things better in this highly competitive and complex market."</p>
                    <p><span class="name">Marco Englert</span> <span class="job_title">MBA, PHD, CSM, CGM, CFM, CTL, CSMP</span> <br> <span class="location">Frankfurt, Germany</span></p>
                </div>
            </div>
        </section>
        <!-- End rates -->
        <!-- Newsletter -->
        <section class="subscribe">
            <h2>Join Our Newsletter Now</h2>
            <p>Subscribe to GAQM mailing list to receive update on new Certifications, Special Offers and Discount Information.</p>
            <form action="#" method="post">
                <input type="email" name="email" id="email" placeholder="Enter Your Email" />
                <input type="submit" value="Subscribe" />
            </form>
        </section>


        @extends('components.footer')
        <script src="../js/main.js"></script>
</body>
</html>





    

