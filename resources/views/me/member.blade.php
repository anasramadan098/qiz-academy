@extends('me.layout')

@section('active',4)

@section('content')
            <h3 class="title">Be A Member</h3>

            @if (Auth::user()->role == 'member')
                    <div class="member">
                        <h4>You Are Now A Member</h4>
                        <p>Your Subscription Start At: {{Auth::user()->role_start_date}}</p>
                    
                        <p>Your Subscription End At: {{ $endDate->format('Y-m-d') }}</p>
                        <p>Remaining: {{ $remainingMonths }} Months</p>
                        
                    </div>
            @else
                <div class="member">
                    <p>To Be A Mebmer You Must Pay 50$ For 1 Year</p>
                    <form action="/beMember" method="POST">
                        @csrf
                        <input type="submit" class="btn" value="Pay">
                    </form>
                </div>

            @endif

@endsection