@extends('frontend.main_master')
@section('main')

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg9">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="/">Home</a>
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

                    <?php $empty_array = []; ?>

                    @foreach ($rooms as $room)

                    @php
                        $bookings = App\Models\Bookings::withCount('assign_rooms')->whereIn('id',$check_date_booking_ids)->where('rooms_id',$room->id)->get()->toArray();
                        $total_book_room = array_sum(array_column($bookings,'assign_rooms_count'));
                        $av_room = @$room->room_numbers_count-$total_book_room;
                    @endphp
                    
                    @if ($av_room > 0 && old('persons') <= $room->room_capacity)

                    <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                            <a href="{{ route('search_room_details',$room->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&persons='.old('persons'))}}">
                                <img src="{{ asset('upload/room/'.$room->image)}}" alt="Images" style="width: 550px; height:300px;">
                            </a>
                            <div class="content">
                                <h5><a href="{{ route('search_room_details',$room->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&persons='.old('persons'))}}"
                                     class="text-dark">{{$room['type']['name']}}</a></h5>
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

                    @else
                        <?php array_push($empty_array, $room->id) ?>

                    @endif 


                    @endforeach


                    @if (count($rooms) == count($empty_array))
                    <p class="text-center text-danger">Sorry No Data Found</p>

                    @endif
                </div>
            </div>
        </div>
        <!-- Room Area End -->


@endsection