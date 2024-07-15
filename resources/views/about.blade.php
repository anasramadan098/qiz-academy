<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="css/register.css">
        <style>
            .bg {
                background-image: url("https://gaqm.org/assets/img/banner/banner15.jpg");
            }
        </style>
    @endsection

</head>
<body>
    @include('components.header')
    <div class="bg">
        <h1>Who We Are</h1>
    </div>
    <section class="text">
        <span class="nav">
            <a href="/">Home</a> / Who We Are
        </span>
        <h3>Who We Are</h3>
        <p>
            Welcome to QIC ACADEMY, your premier destination for self-paced training courses designed to empower individuals through flexible and accessible learning experiences. We specialize in offering a diverse selection of training programs across various industries and disciplines, catering to learners who value independence and personal growth.
        </p>
        <p>
            At QIC ACADEMY, we believe in the transformative impact of self-directed learning. Our courses are meticulously crafted by industry experts to ensure they are not only informative but also practical and relevant to current trends and demands. Whether you're looking to enhance your professional skills, prepare for certifications, or explore new interests, our platform provides the tools and resources needed to achieve your goals.        </p>
        <p>
            What sets us apart is our commitment to quality education and user-centric learning experiences. We offer interactive modules, comprehensive study materials, and ongoing support to help you succeed on your learning journey. Our community of learners is diverse and inclusive, fostering collaboration and knowledge-sharing among peers.
        </p>
        <p>
            Join us at QIC ACADEMY and embark on a journey of self-improvement and achievement. Take control of your learning path, gain valuable insights, and unlock new opportunities with our empowering training courses. Start learning with us today and discover the endless possibilities that await you.
        </p>
    </section>



        @extends('components.footer')

        <script src="{{asset('js/main.js')}}"></script>
</body>
</html>