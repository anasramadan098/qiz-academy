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
                {{$course->name}}
            </h1>
        </div>
        <section>

            <style>
                img {
                    width: 100%;
                    height: auto;
                    transition: 5s;
                }
                iframe {
                    width:100%;
                    height: 1000px;
                    margin:30px 0;
                } 
            </style>

            
            @if ($path == false)
                {{-- Long Course --}}
                <iframe src="{{asset($file->path)}}"></iframe>
                
                <a href="/certiication?t=l&id={{$course->id}}" class="btn">Next</a>
            @else
                {{-- Short Course --}}

                <iframe src="{{asset($path)}}"></iframe>


                <a href="/get-certifcate/s/{{$course->id}}" class="btn">Get Certificate</a>
            @endif
            


        </section>
        
        
        



        @extends('components.footer')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.7.0/viewer.min.js"></script>

        <script>

        </script>
            
        <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
