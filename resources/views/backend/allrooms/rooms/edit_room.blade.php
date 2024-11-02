@extends('admin.admin_dashboard');
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
				<div class="container">
					<div class="main-body">
						<div class="row">
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Manage Room </div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false" tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Room Number</div>
                    </div>
                </a>
            </li>

        </ul>
        <div class="tab-content py-3">
            <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">

                <div class="col-xl-12 mx-auto">

                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Update Room</h5>
                            <form class="row g-3" action="{{route('room.update' , $room_edit->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-4">
                                    <label for="input1" class="form-label">Room Type Name</label>
                                    <input type="text" class="form-control" id="input1" name="roomtype_id" value="{{ $room_edit['type']['name'] }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="input2" class="form-label">Total Adult</label>
                                    <input type="text" class="form-control" id="input2" name="total_adult" value="{{ $room_edit->total_adult }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="input3" class="form-label">Total Child</label>
                                    <input type="text" class="form-control" id="input3" name="total_child" value="{{ $room_edit->total_child }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="input3" class="form-label">Main Image </label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <img id="showImage" src="{{ (!empty($room_edit->image) ? url('upload/room/'.$room_edit->image) : url('upload/no_image.jpg') )}}" alt="roomimg" class=" bg-primary" width="70" height="50">
                                </div>
                                <div class="col-md-6">
                                    <label for="input4" class="form-label">Gallery Image </label>
                                    <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple accept="image/jpeg, image/jpg, image/gif, image/png" >
                                    <div class="d-flex flex-wrap mr-2" id="preview_img"></div>

                                    @foreach ($multiimg as $item)
                                        <img  src="{{ (!empty($item->multi_img) ? url('upload/room/multi_img/'.$item->multi_img) : url('upload/no_image.jpg') )}}" alt="roomimg" class=" bg-primary" width="70" height="50">
                                        <a href="{{route('multi_img.delete' , $item->id)}}" class="me-2"><i class="lni lni-close text-danger fw-bold "></i> </a>  
                                        @endforeach
                                </div>
                        
                        
                                <div class="col-md-3">
                                    <label for="input1" class="form-label">Room Price  </label>
                                    <input type="text" name="price" class="form-control" id="input1" value="{{ $room_edit->price }}" >
                                </div>

                                <div class="col-md-3">
                                    <label for="input2" class="form-label">Size</label>
                                    <input type="text" name="size" class="form-control" id="input2"  value="{{ $room_edit->size }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="input2" class="form-label">Discount ( % )</label>
                                    <input type="text" name="discount" class="form-control" id="input2"  value="{{ $room_edit->discount }}">
                                </div>
                        
                                <div class="col-md-3">
                                    <label for="input2" class="form-label">Room Capacity </label>
                                    <input type="text" name="room_capacity" class="form-control" id="input2" value="{{ $room_edit->room_capacity }}">
                                </div>
                        
                                <div class="col-md-6">
                                    <label for="input7" class="form-label">Room View </label>
                                    <select name="view" id="input7" class="form-select">
                                        <option selected="">Choose...</option>
                                        <option value="Sea View" {{$room_edit->view == 'Sea View'?'selected':''}}>Sea View </option>
                                        <option value="Hill View" {{$room_edit->view == 'Hill View'?'selected':''}}>Hill View </option>
                        
                                    </select>
                                </div>
                        
                                <div class="col-md-6">
                                    <label for="input7" class="form-label">Bed Style</label>
                                    <select name="bed_style" id="input7" class="form-select">
                                        <option selected="">Choose...</option>
                                        <option value="Queen Bed" {{$room_edit->bed_style == 'Queen Bed'?'selected':''}}> Queen Bed </option>
                                        <option value="Twin Bed" {{$room_edit->bed_style == 'Twin Bed'?'selected':''}}>Twin Bed </option>
                                        <option value="King Bed" {{$room_edit->bed_style == 'King Bed'?'selected':''}}>King Bed </option>
                                    </select>
                                </div>
                        
                                <div class="col-md-12">
                                    <label for="input11" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" placeholder="Short Description..." rows="3">{{$room_edit->short_desc}}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="input11" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description..." rows="3">{{ $room_edit->description }}</textarea>
                                </div>
                                

                                <div class="row mt-2">
                                    <div class="col-md-12 mb-3">
                                       @forelse ($basic_facility as $item)
                                       <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                                          <div class="row add_item">
                                             <div class="col-md-8">
                                                <label for="facility_name" class="form-label"> Room Facilities </label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                      <option value="">Select Facility</option>
                                                      <option value="Complimentary Breakfast" {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}>Complimentary Breakfast</option>
                                     <option value="32/42 inch LED TV"  {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}> 32/42 inch LED TV</option>
                                   
                                    <option value="Smoke alarms"  {{$item->facility_name == 'Smoke alarms'?'selected':''}}>Smoke alarms</option>
                                   
                                    <option value="Minibar" {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}> Minibar</option>
                                   
                                    <option value="Work Desk"  {{$item->facility_name == 'Work Desk'?'selected':''}}>Work Desk</option>
                                   
                                    <option value="Free Wi-Fi" {{$item->facility_name == 'Free Wi-Fi'?'selected':''}}>Free Wi-Fi</option>
                                   
                                    <option value="Safety box" {{$item->facility_name == 'Safety box'?'selected':''}} >Safety box</option>
                                   
                                    <option value="Rain Shower" {{$item->facility_name == 'Rain Shower'?'selected':''}} >Rain Shower</option>
                                   
                                    <option value="Slippers" {{$item->facility_name == 'Slippers'?'selected':''}} >Slippers</option>
                                   
                                    <option value="Hair dryer" {{$item->facility_name == 'Hair dryer'?'selected':''}} >Hair dryer</option>
                                   
                                    <option value="Wake-up service"  {{$item->facility_name == 'Wake-up service'?'selected':''}}>Wake-up service</option>
                                   
                                    <option value="Laundry & Dry Cleaning" {{$item->facility_name == 'Laundry & Dry Cleaning'?'selected':''}} >Laundry & Dry Cleaning</option>
                                    
                                    <option value="Electronic door lock"  {{$item->facility_name == 'Electronic door lock'?'selected':''}}>Electronic door lock</option> 
                                                </select>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group" style="padding-top: 30px;">
                                                      <a class="btn btn-success addeventmore" style="padding: 8px;"><i class="lni lni-circle-plus m-auto"></i></a>
                                                      <span class="btn btn-danger btn-sm removeeventmore" style="padding: 8px;"><i class="lni lni-circle-minus m-auto"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                   
                                       @empty
                                   
                                            <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                                                <div class="row add_item">
                                                    <div class="col-md-6">
                                                        <label for="basic_facility_name" class="form-label">Room Facilities </label>
                                                        <select name="facility_name[]" id="basic_facility_name" class="form-control">
                                    <option value="">Select Facility</option>
                                    <option value="Complimentary Breakfast">Complimentary Breakfast</option>
                                    <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
                                    <option value="Smoke alarms" >Smoke alarms</option>
                                    <option value="Minibar"> Minibar</option>
                                    <option value="Work Desk" >Work Desk</option>
                                    <option value="Free Wi-Fi">Free Wi-Fi</option>
                                    <option value="Safety box" >Safety box</option>
                                    <option value="Rain Shower" >Rain Shower</option>
                                    <option value="Slippers" >Slippers</option>
                                    <option value="Hair dryer" >Hair dryer</option>
                                    <option value="Wake-up service" >Wake-up service</option>
                                    <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
                                    <option value="Electronic door lock" >Electronic door lock</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding-top: 30px;">
                                            <a class="btn btn-success addeventmore" style="padding: 8px;" ><i class="lni lni-circle-plus m-auto"></i></a>
                                           <span class="btn btn-danger removeeventmore" style="padding: 8px;" ><i class="lni lni-circle-minus m-auto"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                   
                                       @endforelse
                                                        </div> 
                                                     </div>
                                                     <br>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>





            </div>
             {{-- // End primaryhome --}}

             
            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" onclick="AddRoomNb()" id="roomnb_add"><i class='bx bx-plus'></i>Add New</a>


                        <div class="roomnoHide mt-3" id="roomnb_form">
                            <form action="{{route('store.roomnb',$room_edit->id)}}" method="POST">
                                @csrf


                                <input type="hidden" value="{{$room_edit->roomtype_id}}" name="roomtype_id">


                                <div class="row">
                                <div class="col-md-4">
                                    <label for="input2" class="form-label">Room Nb</label>
                                    <input type="text" name="room_nb" class="form-control">
                                </div>
                
                                <div class="col-md-4">
                                    <label for="input7" class="form-label">Status</label>
                                    <select name="status" id="input7" class="form-select">
                                        <option selected="">Select Status...</option>
                                        <option value="Active">Active </option>
                                        <option value="Inactive">Inactive  </option>
                
                                    </select>
                                </div> 
                
                                <div class="col-md-4">
                
                                    <button type="submit" class="btn btn-success" style="margin-top: 28px;">Save</button>
                
                                </div>
                
                
                            </div>
                
                            </form>
                        </div>
                        <table class="table mb-0 table-striped mt-3" id="roomnb_table">
                            <thead>
                                <tr>
                                    <th scope="col">Room Number</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($room_nb as $roomnb)
                                <tr>
                                    <td>{{$roomnb->romm_nb}}</td>
                                    <td>{{$roomnb->status}}</td>
                                    <td>
                                        <a href="{{route('roomnb.edit',$roomnb->id)}}" class="btn btn-warning px-3 radius-30">Edit</a>
                                        <a href="{{route('roomnb.delete',$roomnb->id)}}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>  
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
			</div>
		</div>
</div>
 </div>







{{-- //show selected img --}}
 <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var imageInput = document.getElementById('image');
        var showImage = document.getElementById('showImage');

        imageInput.addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                showImage.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

{{-- // multi_img --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var multiImg = document.getElementById('multiImg');
        var preview_img = document.getElementById('preview_img');

        multiImg.addEventListener('change', function(event) {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                const files = event.target.files;

                Array.from(files).forEach(file => {
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                        const fileReader = new FileReader();

                        fileReader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.width = 100;
                            img.height = 80;
                            
                            img.style.margin = '5px';  // Adding margin to each image

                            preview_img.appendChild(img);
                        };

                        fileReader.readAsDataURL(file);
                    }
                });
            } else {
                alert("Your browser doesn't support File API!");
            }
        });
    });
</script>
<!--========== Start of add Basic Plan Facilities ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="basic_facility_section_remove" id="basic_facility_section_remove">
          <div class="container mt-2">
             <div class="row">
                <div class="form-group col-md-6">
                   <label for="basic_facility_name">Room Facilities</label>
                   <select name="facility_name[]" id="basic_facility_name" class="form-control">
                         <option value="">Select Facility</option>
                        <option value="Complimentary Breakfast">Complimentary Breakfast</option>
                        <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
                        <option value="Smoke alarms" >Smoke alarms</option>
                        <option value="Minibar"> Minibar</option>
                        <option value="Work Desk" >Work Desk</option>
                        <option value="Free Wi-Fi">Free Wi-Fi</option>
                        <option value="Safety box" >Safety box</option>
                        <option value="Rain Shower" >Rain Shower</option>
                        <option value="Slippers" >Slippers</option>
                        <option value="Hair dryer" >Hair dryer</option>
                        <option value="Wake-up service" >Wake-up service</option>
                        <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
                        <option value="Electronic door lock" >Electronic door lock</option> 
                   </select>
                </div>
                <div class="form-group col-md-6" style="padding-top: 20px">
                   <span class="btn btn-success addeventmore" style="padding: 8px;"><i class="lni lni-circle-plus m-auto"></i></span>
                   <span class="btn btn-danger removeeventmore" style="padding: 8px;"><i class="lni lni-circle-minus m-auto"></i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 


 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#basic_facility_section_remove").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of Basic Plan Facilities ==============-->

 {{-- Hide and Add room number --}}

<script>
    $('#roomnb_form').hide();
    $('#roomnb_table').show();
    function AddRoomNb(){
        $('#roomnb_form').show();
        $('#roomnb_table').hide();
        $('#roomnb_add').hide();
    }
</script>

@endsection
