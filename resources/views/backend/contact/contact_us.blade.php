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
                    <li class="breadcrumb-item active" aria-current="page">All Contacts</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                        <table  class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="50px">Nb</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $key=>$item)
                            <tr>

                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->message}}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans()  }}</td>


                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>

            
    
    </div>
@endsection