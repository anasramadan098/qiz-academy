@extends('admin.layout.layout')

@section('active',1)

@section('content')

    <div>
        <h2>Files</h2>
        <div class="boxes">
            <div class="box head">
                <h4>Name</h4>
                <h4>Price</h4>
                <h4>Edit \ Remove</h4>
            </div>
            @foreach ($forms as $file)
                <div class="box">
                    <h4>{{$file->name}}</h4>
                    <h4>{{$file->price}}</h4>
                    <div class="btns">
                        <a class="btn" href="?edit-file={{$file->id}}">Edit</a>
                        <a class="btn" href="/remove-file-{{$file->id}}">Remove</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if (request()->has('edit-file'))
        <div>
            <h2>Edit File</h2>
            <form action="/edit-file-{{$file->id}}" enctype="multipart/form-data" method="POST">
                @csrf

                <input type="text" required value="{{$file->name}}"  placeholder="File Name" name="name"/>
                <input type="number" placeholder="Price" value="{{$file->price}}" name="price"/>
                <input type="file" name="path" id="file" />


                <input type="submit" class="btn" value="Edit File">
            </form>
        </div>
    @else
        <div>
            <h2>Add File</h2>
            <form action="/new-file" enctype="multipart/form-data" method="POST">
                @csrf

                <input type="text" required  placeholder="File Name" name="name">
                <input type="number" placeholder="Price" name="price">
                <input type="file" name="path">

                <input type="submit" class="btn" value="Add File">
            </form>
        </div>
    
    @endif



@endsection