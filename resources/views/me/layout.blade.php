<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/me.css')}}">
    @endsection
<body>
        <header>
            <ul class="sub-menu">
                <li><a href="/change-password">Change Password</a></li>
                <li><a href="/log-out">Log Out</a></li>
            </ul>
            <div class="holder">
                <img src="../imgs/logo.png" alt="logo">
                <h1>Welcome <span>{{Auth::user()->full_name}}</span></h1>
                <div class="cards" data-active="@yield('active')">
                    <div class="card">
                        <a href="/me">
                            <img src="../imgs/profile.png" alt="profile">
                            <span>My Profile</span>
                        </a>
                    </div>
                    <div class="card">
                        <a href="/my_short_courses">
                            <img src="../imgs/profile.png" alt="profile">
                            <span>My Short Courses</span>
                        </a>
                    </div>
                    <div class="card">
                        <a href="/my_long_courses">
                            <img src="../imgs/profile.png" alt="profile">
                            <span>My Long Courses</span>
                        </a>
                    </div>
                    <div class="card">
                        <a href="/my_forms">
                            <img src="../imgs/profile.png" alt="profile">
                            <span>My Forms</span>
                        </a>
                    </div>
                    <div class="card">
                        <a href="/be-member">
                            <img src="../imgs/profile.png" alt="profile">
                            <span>Be A Member</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>


        <section>
            <div class="container">

        @yield('content')

            </div>
        </section>

        <footer>
            <p>© 2024 GAQM, All Rights Reserved</p>
            <ul class="links">
                <li>
                    <a href="/course-methodology">Course Methodology</a>
                </li>
                <li>
                    <a href="/terms-and-conditions">Terms And Conditions</a>
                </li>
            </ul>
        </footer>


        <script>
            const activeIndex = document.querySelector('.cards').getAttribute('data-active');
            const cards = document.querySelectorAll('.cards .card a');

            // Add Active On The Correct Card
            cards[activeIndex].classList.add('active');
        </script>
</body>
</html>