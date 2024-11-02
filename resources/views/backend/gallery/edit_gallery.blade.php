@extends('admin.admin_dashboard')
@section('admin') 
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit Gallery </div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Gallery</li>
							</ol>
						</nav>
					</div>
					 
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
						 
    <div class="col-lg-12">
        
        <div class="card">
            <div class="card-body p-4">
                
       <form  class="row g-3" action="{{ route('update.gallery') }}" method="post" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="id" value="{{ $gallery->id }}">        
    
    <div class="col-md-6">
        <label for="input1" class="form-label">Gallery Image </label>
        <input type="file" name="photo_name" class="form-control" id="image" >
         
    </div>
    <div class="col-md-6">
        <label for="input1" class="form-label">  </label>
        <img src="{{ asset('upload/Gallery/'.$gallery->photo_name) }}" alt="" style="width: 70px; height:70px;" id="showImage">
         
    </div>
 
                 
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes </button>
                            
                        </div>
                    </div>
                </form>
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
           
 
@endsection