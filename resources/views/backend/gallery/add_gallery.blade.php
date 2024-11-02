@@ -0,0 +1,93 @@
@extends('admin.admin_dashboard')
@section('admin') 

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Add Gallery</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Gallery</li>
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
                
       <form  class="row g-3" action="{{ route('store.gallery') }}" method="post" enctype="multipart/form-data">
         @csrf
    
    <div class="col-md-6">
        <label for="input4" class="form-label">Gallery Image </label>
        <input type="file" name="photo_name[]" class="form-control" id="multiImg" multiple accept="image/jpeg, image/jpg, image/gif, image/png" >
        <div class="d-flex flex-wrap mr-2" id="preview_img"></div>
    </div>
 
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">ADD</button>
                            
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
@endsection