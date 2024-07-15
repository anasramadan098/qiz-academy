<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <style>
            .bg {
                background: url(https://gaqm.org/assets/img/banner/banner3.jpg);
            }
            section {
                padding: 20px 0 50px;
            }
        </style>
    @endsection
<body>
    @include('components.header')

        <div class="bg">
            <h1 class="right">
                Comprehensive Certifications Portfolio
            </h1>
        </div>
        <section>
            <span>
                <a href="/">Home</a> / <a href="#">Certifications</a> / All Certifications
            </span>
            <h2 class="title">All Certifications</h2>
            <div class="cards">

                @if (request()->t == 's')
                    @foreach ($alldata as $data)
                        <a href="/certiication?t=s&id={{ $data->id }}">
                            <div class="card">
                                <h3>{{$data->name}}</h3>
                                <i class="fa-solid fa-laptop-file"></i>
                            </div>
                        </a>
                    @endforeach 
                @elseif (request()->t == 'l')
                    @foreach ($alldata as $data)
                        <a href="/certiication?t=l&id={{ $data->id }}">
                            <div class="card">
                                <h3>{{$data->name}}</h3>
                                <i class="fa-solid fa-laptop-file"></i>
                            </div>
                        </a>
                    @endforeach 
                @else
                    @foreach ($alldata as $data)
                        <a href="/buy-form/{{$data->id}}">
                            <div class="card">
                                <h3>{{$data->name}}</h3>
                                <i class="fa-solid fa-laptop-file"></i>
                            </div>
                        </a>
                    @endforeach 
                @endif


            </div>
        </section>



        @extends('components.footer')


        <script src="../js/main.js"></script>
</body>
</html>
