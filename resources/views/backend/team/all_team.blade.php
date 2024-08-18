@extends('admin.admin_dashboard');
@section('admin')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Manage Team</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Team</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <a href="{{route('add.team')}}" class="btn btn-outline-primary px-5 radius-30">Add Team</a>                                
                </ol>
            </nav>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 mt-2 text-uppercase">All Team</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Facebook</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($team as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{url('upload/team/'.$item->image )}}" alt="img" style="width:60px; height:40px;"></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->position}}</td>
                                <td>{{$item->facebook}}</td>
                                <td>
                                    <a href="{{route('team.edit',$item->id)}}" class="btn btn-warning px-3 radius-30">Edit</a>
                                    <a href="{{route('team.delete',$item->id)}}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>                                
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>

            
    
    </div>
@endsection