@extends('admin.admin_dashboard');
@section('admin')

    <div class="page-content">
 	<!--breadcrumb-->
     <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

         
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">

                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Gallery</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.gallery') }}" class="btn btn-primary px-5">Add Gallery</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('delete.gallery.multiple') }}" method="POST">
                        @csrf
                        <table  class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="50px">Select</th>
                                <th width="50px">Nb</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gallery as $key=>$item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selectedItem[]" value="{{ $item->id }}">
                                </td>
                                <td>{{$key+1}}</td>
                                <td><img src="{{url('upload/Gallery/'.$item->photo_name )}}" alt="img" style="width:100px; height:60px;"></td>
                                <td>
                                    <a href="{{ route('edit.gallery',$item->id) }}" class="btn btn-warning px-3 radius-30"> Edit</a>
                                    <a href="{{ route('delete.gallery',$item->id) }}" class="btn btn-danger px-3 radius-30" id="delete"> Delete</a>                          
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    <button type="submit" class="btn btn-danger">Delete Selected</button>
                </form> 
                </div>
            </div>
        </div>

            
    
    </div>
@endsection