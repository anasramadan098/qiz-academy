@extends('me.layout')


@section('content')
    <style>
            .error {
                color: red;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                margin: 50px 0;
            }
    </style>
            <h3 class="title">Personal Details</h3>
            <form action="/change-passwrod" method="POST">
                @csrf
                <div class="input">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password">
                    <span class="error">{{$errors->first('password')}}</span>
                </div>
                <div class="input">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password">
                </div>
                <div class="input">
                    <label for="confirm_password">Current Password</label>
                    <input type="password" name="confirm_password" id="confirm_password">
                    <span class="error">{{$errors->first('confirm_password')}}</span>
                </div>
                @if (strlen($msg) != 0)
                    <div class="error">
                        {{$msg}}
                    </div>
                @endif
                <button class="btn">Change Password</button>
            </form>
@endsection