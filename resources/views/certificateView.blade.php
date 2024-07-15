<!DOCTYPE html>
<html lang="en">
    @extends('components.head')
    @section('adds')
        <link rel="stylesheet" href="{{asset('css/single-view.css')}}">
        <style>
        .bg {
                background: url(https://gaqm.org/assets/img/banner/banner3.jpg);
            }
        </style>
    @endsection
<body>
    @include('components.header')
    <div class="bg">
        <h1 class="right">Get Certificate For {{Auth::user()->full_name}}</h1>
    </div>
    <section class="info">
        <h2 class="title">{{Auth::user()->full_name}} Certificate</h2>
        @if ($specif->exam !== 'not_have') 
            @if ($specif->exam->solved === false || $specif->exam->solved === 0)
                <a href="/exam/{{$specif->id}}" style="font-size: 20px; "  class="btn">Solve The Exam First</a>
            @else
                <img class="certificate" src="{{asset("$imageSrc")}}">
                <a href='{{asset("$imageSrc")}}' download="" class="btn">Downaload</a>
                {{-- Linkedin Share Link --}}
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{asset("$imageSrc")}}&title=My New Certificate!"
                 class="btn" target="_blank">
                    Share on LinkedIn
                </a>
            @endif

        @elseif ($specif->exam === 'not_have')

            @if ($specif->certificate === 1 || $specif->certificate === true)
                <img class="certificate" src="{{asset("$imageSrc")}}">
                <a href='{{asset("$imageSrc")}}' download="" class="btn">Downaload</a>
                {{-- Linkedin Share Link --}}
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{asset("$imageSrc")}}&title=My New Certificate!"
                class="btn" target="blank">
                    Share on LinkedIn
                </a>
            @else 
                <a href="/certificate/buy-{{$specif->id}}" class="btn">Buy Certificate For {{$specif->certificate_price}}$</a>
            @endif

        @endif 

    </section>
        @extends('components.footer')

        <script src="../js/main.js"></script>
        <script>
            if (document.querySelectorAll('.info .holder')) {
                document.querySelectorAll('.info .holder').forEach(e => {
                    e.addEventListener('click', () => {
                        e.classList.toggle('active')
                    })

                })
            }

            // LinkedIn Share Functionality
            // const shareButtons = document.querySelectorAll('.share-linkedin');
            // shareButtons.forEach(button => {
            //     button.addEventListener('click', (event) => {
            //         event.preventDefault(); // Prevent default link behavior
            //         const certificateUrl = button.dataset.certificateUrl;
            //         const shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${certificateUrl}&title=My New Certificate!`;
            //         window.open(shareUrl, '_blank'); // Open in a new tab
            //     });
            // });

        </script>
</body>
</html>