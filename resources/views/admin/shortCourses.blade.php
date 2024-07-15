@extends('admin.layout.layout')

@section('active',2)

@section('content')

    <div>
        <h2>Short Courses</h2>
        <div class="boxes">
            <div class="head box">
                <h4>Name</h4>
                <h4>Price</h4>
                <h4>Success Degree</h4>
                <h4>Actions</h4>
            </div>

            @foreach($courses as $course)
                <div class="box">
                    <h4>{{$course->name}}</h4>
                    <p>{{$course->certificate_price}}</p>
                    <p>{{$course->success_degree}}</p>
                    <div class="btns">
                        <a class="btn" href="?edit-scourse={{$course->id}}">Edit</a>
                        <a href="/remove-scourse-{{$course->id}}" class="btn">Remove</a>
                        {{-- <form action="/remove-scourse-{{$course->id}}" method="GET" enctype="multipart/form-data">
                            <input type="hidden" name="path" value="{{$course->path}}">
                            <input type="submit" class="btn" value="Remove">
                        </form> --}}
                    </div>
                </div>
            @endforeach

        </div>    
    </div>

    @if (request()->has('edit-scourse'))
        <div>
            <h2>Edit Short Course</h2>
            <form action="/edit-scourse-{{$course->id}}" enctype="multipart/form-data" method="POST">
                @csrf

                <input type="text" required  placeholder="Course Name" name="name" value="{{$course->name}}">
                <input type="number" placeholder="Certificate Price" name="certificate_price" value="{{$course->certificate_price}}">
                
                <input type="file" name="path"  value="{{$course->path}}">
                
                <input type="submit" class="btn" value="Edit File">
            </form>
        </div>
    @else
        <div>
            <h2>Add Short Course</h2>
            <form action="/new-short-course" enctype="multipart/form-data" method="POST">
                @csrf

                <input type="text" required  placeholder="Course Name" name="name">
                <input type="number" placeholder="Certificate Price" name="certificate_price">
                
                <input type="file" name="path">
                
                <input type="submit" class="btn" value="Add File">
            </form>
        </div>
    @endif


@endsection