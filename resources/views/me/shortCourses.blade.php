@extends('me.layout')

@section('active',1)

@section('content')
            <h3 class="title">My Simle Courses</h3>

            @if (count(json_decode(Auth::user()->short_courses)) > 0)
                <div class="boxes">
                    @foreach (json_decode(Auth::user()->short_courses) as $course)
                        <div class="box">
                            <i class="fa fa-graduation-cap"></i>
                            <div class="text">
                                <h4>{{$course->name}}</h4>
                                <p></p>
                            </div>
                            <div class="btns">
                                <a href="/certiication?t=s&id={{$course->id}}" class="btn sec">View Course</a>
                                <a href="/get-certifcate/s/{{$course->id}}" class="btn">Download Certificate</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
            <a href="/categories?t=s">
                <p class="not-found">Not Items Have Purcheshed. Click Here To View The Short Courses</p>
            </a>
            @endif

@endsection