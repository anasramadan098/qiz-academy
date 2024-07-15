<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    @endsection
<body>


        <form action="">
            <img src="/imgs/logo.png" alt="">
            <h2>Enter Your Email Address</h2>
            <input type="email" name="email" placeholder="Email" />
            <input type="submit" value="Resend Username" class="btn"/>
            <div class="links">
                <a href="/login">Log in</a>
                <a href="/registration">New user? Sign up here</a>
            </div>
        </form>
        <p>© 2024 GAQM, All Rights Reserved</p>


</body>
</html>





    

