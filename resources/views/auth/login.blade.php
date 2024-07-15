<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    @endsection
<body>


    <form action="/login" method="POST">
        @csrf
        <img src="/imgs/logo.png" alt="" />
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="submit" value="Login" class="btn"/>
        <div class="links">
            <a href="/registration">New user? Sign up here</a>
            <a href="/forgot_username">Forgot Username?</a>
            <a href="/forgot_password">Forgot Password?</a>
        </div>
    </form>
    <p>© 2024 GAQM, All Rights Reserved</p>

</body>
</html>





    

