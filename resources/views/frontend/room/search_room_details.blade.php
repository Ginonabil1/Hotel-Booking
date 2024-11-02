@extends('frontend.main_master')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <!-- Inner Banner -->
        <div class="inner-banner inner-bg10">
            <div class="container">
                <div class="inner-title">
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>Room Details </li>
                    </ul>
                    <h3>{{$room['type']['name']}}</h3>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Room Details Area End -->
        <div class="room-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="room-details-side">
                            <div class="side-bar-form">
                                <h3>Booking Sheet </h3>

                                <form action="{{route('user_booking_store' , $room->id)}}" method="post" id="bk_form">
                                    @csrf
                                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                                
                                
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Check in</label>
                                                <div class="input-group">
                                                    <input autocomplete="off"  type="text" required name="check_in" id="check_in"  class="form-control dt_picker" value="{{ old('check_in') ? date('Y-m-d', strtotime(old('check_in'))) : '' }}" >
                                                    <span class="input-group-addon"></span>
                                                </div>
                                                <i class='bx bxs-calendar'></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Check Out</label>
                                                <div class="input-group">
                                   <input autocomplete="off"  type="text" required name="check_out" id="check_out"  class="form-control dt_picker" value="{{ old('check_out') ? date('Y-m-d', strtotime(old('check_out'))) : '' }}" >
                                                    <span class="input-group-addon"></span>
                                                </div>
                                                <i class='bx bxs-calendar'></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Numbers of Persons</label>
                                                <select class="form-control" name="persons" id="nmbr_person">
                                                @for ($i = 1; $i <= 4; $i++) 
                                      <option {{ old('persons') == $i ? 'selected' : '' }} value="{{ $i }}" >0{{ $i }} </option>
                                              @endfor
                                                </select>	
                                            </div>
                                        </div>
                                        <input type="hidden" id="total_capacity" value="{{ $room->room_capacity }}">
                                        <input type="hidden" id="room_price" value="{{ $room->price }}">
                                        <input type="hidden" id="discount_p" value="{{ $room->discount }}">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Numbers of Rooms</label>
                                                <select class="form-control number_of_rooms" name="number_of_rooms" id="select_room">
                                                    @for ($i = 1; $i <= 5; $i++)  
                                                    <option value="0{{ $i }}">0{{ $i }}</option>
                                                    @endfor
                                                    
                                                </select>	
                                            </div>
                                            <input type="hidden" name="available_room" id="available_room" >
                                            <p class="available_room"></p>
                                        </div>
                                     
                                        <div class="col-lg-12">
                                            <table class="table">
                                                
                                    <tbody>
                                        <tr> 
                                        <td><p> SubTotal</p></td>
                                        <td style="text-align: right" ><span class="t_subtotal">0</span> </td> 
                                        </tr>
                                        <tr> 
                                        <td><p> Discount</p></td>
                                        <td style="text-align: right" ><span class="t_discount">0</span></td> 
                                        </tr>
                                        <tr> 
                                        <td><p> Total</p></td>
                                        <td style="text-align: right" ><span class="t_g_total">0</span></td> 
                                        </tr>
                                        
                                    </tbody>
                                              </table>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                                Book Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                          
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="room-details-article">
                            <div class="room-details-slider owl-carousel owl-theme">

                                @foreach ($images as $item)
                                    
                                    <div class="room-details-item">
                                        <img src="{{asset('upload/room/multi_img/'.$item->multi_img)}}" alt="Images">
                                    </div>

                                @endforeach
                            </div>


 


                            <div class="room-details-title">
                                <h2>{{$room['type']['name']}}</h2>
                                <ul>
                                    
                                    <li>
                                       <b> Basic : {{$room->price}}$/Night/Room</b>
                                    </li> 
                                 
                                </ul>
                            </div>

                            <div class="room-details-content">
                                <p>
                                    {{$room->description}}
                                </p>

                           <div class="side-bar-plan">
                                <h3>Basic Plan Facilities</h3>
                                <ul>
                                    @foreach ($facilities as $item)

                                    <li><a href="#">{{$item->facility_name}}</a></li>

                                    @endforeach

                                </ul>

                                
                            </div>


<div class="row"> 

    <div class="col-lg-6">

    <div class="services-bar-widget">
            <h3 class="title">Room Details</h3>
            <div class="side-bar-list">
                <ul>
                <li>
                        <a href="#"> <b>Capacity : </b> {{$room->room_capacity}} Person <i class='bx bxs-cloud-download'></i></a>
                    </li>
                    <li>
                        <a href="#"> <b>Size : </b> {{$room->size}}ft2 <i class='bx bxs-cloud-download'></i></a>
                    </li>
                
                
                </ul>
            </div>
        </div>
    </div>


    <div class="col-lg-6">
    <div class="services-bar-widget">
            <h3 class="title">Room Details</h3>
            <div class="side-bar-list">
                <ul>
                <li>
                        <a href="#"> <b>View : </b> {{$room->view}} <i class='bx bxs-cloud-download'></i></a>
                    </li>
                    <li>
                        <a href="#"> <b>Bed Style : </b> {{$room->bed_style}} <i class='bx bxs-cloud-download'></i></a>
                    </li>
                    
                </ul>
            </div>
        </div> 
            </div> 
                        </div>

 </div>
        <div class="room-details-review">
                                <h2>Clients Review and Retting's</h2>
                                <div class="review-ratting">
                                    <h3>Your rating: </h3>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </div>
                                <form >
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control"  cols="30" rows="8" required data-error="Write your message" placeholder="Write your review here.... "></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="default-btn btn-bg-three">
                                                Submit Review
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Room Details Area End -->

        <!-- Room Details Other -->
        <div class="room-details-other pb-70">
            <div class="container">
                <div class="room-details-text">
                    <h2>Other Rooms</h2>
                </div>

                <div class="row ">

                    @foreach ($recommend_rooms as $item)
                        
                        <div class="col-lg-6">
                            <div class="room-card-two">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-md-4 p-0">
                                        <div class="room-card-img">
                                            <a href="{{url('/room/details/'.$item->id)}}">
                                                <img src="{{ asset('upload/room/'.$item->image)}}" alt="Images">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-8 p-0">
                                        <div class="room-card-content">
                                            <h4>
                                                <a href="{{url('/room/details/'.$item->id)}}" class="text-dark">{{$item['type']['name']}}</a>
                                            </h4>
                                            <span>{{$item->price}}$ / Per Night </span>
                                            <div class="rating">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                            </div>
                                            <p>{{$item->short_desc}}</p>
                                            <ul>
                                                <li><i class='bx bx-user'></i> {{$item->room_capacity}} Person</li>
                                                <li><i class='bx bx-expand'></i> {{$item->size}}ft2</li>
                                            </ul>

                                            <ul>
                                                <li><i class='bx bx-show-alt'></i> {{$item->view}}</li>
                                                <li><i class='bx bxs-hotel'></i> {{$item->bed_style}}</li>
                                            </ul>
                                            
                                            <a href={{url('/room/details/'.$item->id)}} class="book-more-btn">
                                                Book Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Room Details Other End -->



        <script>
            $(document).ready(function () {
               var check_in = "{{ old('check_in') }}";
               var check_out = "{{ old('check_out') }}";
               var room_id = "{{ $room_id }}";
               if (check_in != '' && check_out != ''){
                  getAvaility(check_in, check_out, room_id);
               }
               $("#check_out").on('change', function () {
                  var check_out = $(this).val();
                  var check_in = $("#check_in").val();
                  if(check_in != '' && check_out != ''){
                     getAvaility(check_in, check_out, room_id);
                  }
               });
               $(".number_of_rooms").on('change', function () {
                  var check_out = $("#check_out").val();
                  var check_in = $("#check_in").val();
                  if(check_in != '' && check_out != ''){
                     getAvaility(check_in, check_out, room_id);
                  }
               });
            });
            function getAvaility(check_in, check_out, room_id) {
               $.ajax({
                  url: "{{ route('check_room_availability') }}",
                  data: {room_id:room_id, check_in:check_in, check_out:check_out},
                  success: function(data){
                     $(".available_room").html('Availability : <span class="text-success">'+data['available_room']+' Rooms</span>');
                     $("#available_room").val(data['available_room']);
                     price_calculate(data['total_nights']);
                  }
               });
            }
            function price_calculate(total_nights){
               var room_price = $("#room_price").val();
               var discount_p = $("#discount_p").val();
               var select_room = $("#select_room").val();
               var sub_total = room_price * total_nights * parseInt(select_room);
               var discount_price = (parseInt(discount_p)/100)*sub_total;
               $(".t_subtotal").text(sub_total);
               $(".t_discount").text(discount_price);
               $(".t_g_total").text(sub_total-discount_price);
            }
            $("#bk_form").on('submit', function () {
               var av_room = $("#available_room").val();
               var select_room = $("#select_room").val();
               if (parseInt(select_room) >  av_room){
                  alert('Sorry, you select maximum number of room');
                  return false;
               }
               var nmbr_person = $("#nmbr_person").val();
               var total_capacity = $("#total_capacity").val();
               if(parseInt(nmbr_person) > parseInt(total_capacity)){
                  alert('Sorry, you selected maximum number of persons');
                  return false;
               }
            })
         </script>
        
        
        


@endsection