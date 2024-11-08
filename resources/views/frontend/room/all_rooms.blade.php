@extends('frontend.main_master')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg9">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>All Rooms</li>
                    </ul>
                    <h3>Rooms</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Room Area -->
        <div class="room-area pt-100 pb-70">
            <div class="container">
                <div class="section-title text-center">
                    <span class="sp-color">ROOMS</span>
                    <h2>Our Rooms & Rates</h2>
                </div>
                <div class="row pt-45">

                    @foreach ($rooms as $room)
                        
                    <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                            <a href="{{url('/room/details/'. $room->id)}}">
                                <img src="{{ asset('upload/room/'.$room->image)}}" alt="Images" style="width: 550px; height:300px;">
                            </a>
                            <div class="content">
                                <h5><a href="{{url('/room/details/'.$room->id)}}" class="text-dark">{{$room['type']['name']}}</a></h5>
                                <ul>
                                    <li class="text-color">{{$room->price}}$</li>
                                    <li class="text-color">Per Night</li>
                                </ul>
                                <div class="rating text-color">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star-half'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Room Area End -->


@endsection