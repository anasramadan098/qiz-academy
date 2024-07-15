@extends('me.layout')

@section('active',2)

@section('content')
            <h3 class="title">My Advanced Courses</h3>
            @if (count(json_decode(Auth::user()->long_courses)) > 0)
                <div class="boxes">
                    @foreach (json_decode(Auth::user()->long_courses) as $course)
                        <div class="box">
                            <i class="fa fa-graduation-cap"></i>
                            <div class="text">
                                <h4>{{$course->name}}</h4>
                                <p><span class="price">price: {{$course->certificate_price}}$</span> <span class="completed">Completed: {{$course->completed}}%</span></p>
                            </div>
                            <div class="btns">
                                <a href="/certiication?t=l&id={{$course->id}}" class="btn sec">View Course</a>
                                <a href="/get-certifcate/l/{{$course->id}}" class="btn">Download Certificate</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <a href="/categories?t=l">
                    <p class="not-found">Not Items Have Purcheshed. Click Here To View The Long Courses</p>
                </a>
            @endif

@endsection