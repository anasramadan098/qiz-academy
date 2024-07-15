@extends('me.layout')

@section('active',3)

@section('content')
            <h3 class="title">My Forms</h3>

            @if (count(json_decode(Auth::user()->files_buyed)) > 0)
                @foreach (json_decode(Auth::user()->files_buyed) as $file)
                    <div class="form">
                        <h4>{{$file->name}} <span>Price: {{$file->price}}</span></h4>

                        <a href="{{asset($file->path)}}" class="btn" download>Download</a>
                    </div>
                @endforeach
            @else
                <a href="/categories">
                    <p class="not-found">Not Items Have Purcheshed. Click Here To View The Forms Or Files</p>
                </a>
            @endif

@endsection