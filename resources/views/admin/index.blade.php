@extends('admin.admin_dashboard');
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php
  $bookings = App\Models\Bookings::latest()->get();
  $pending = App\Models\Bookings::where('status','0')->get();
  $complete = App\Models\Bookings::where('status','1')->get();
  $totalPrice = App\Models\Bookings::sum('total_price');

  $today = Carbon\Carbon::now()->toDateString();
  $todayprice = App\Models\Bookings::whereDate('created_at',$today)->sum('total_price');
  $todaybooking = App\Models\Bookings::whereDate('created_at',$today)->get();

  $allData = App\Models\Bookings::orderBy('id','desc')->limit(10)->get();
@endphp

<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
         <div class="card radius-10 border-start border-0 border-4 border-info h-75">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Booking</p>
                        <h4 class="my-1 text-info">{{ count($bookings) }}</h4>
                        <p class="mb-0 font-13">Today's Booking: {{ count($todaybooking) }}</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                    </div>
                </div>
            </div>
         </div>
       </div>
       <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-danger h-75">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                    <p class="mb-0 text-secondary">Pending Booking</p>
                    <h4 class="my-1 text-danger">{{ count($pending) }}</h4>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bx-no-entry'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-success h-75">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                    <p class="mb-0 text-secondary">Complete Booking</p>
                    <h4 class="my-1 text-success">{{ count($complete) }}</h4>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bx-user-check'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-warning h-75">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                    <p class="mb-0 text-secondary">Total Price</p>
                    <h4 class="my-1 text-warning">${{ $totalPrice  }}</h4>
                    <p class="mb-0 font-13">Today's Price:  ${{ $todayprice }}</p>
                  </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-wallet'></i>
                   </div>
               </div>
           </div>
        </div>
      </div> 
    </div><!--end row-->

    <div class="row">
       <div class="col-12 col-lg-12 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Bookings Overview</h6>
                    </div>
                </div>
            </div>
              <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                <canvas id="bookingChart"></canvas>
              </div>
          </div>
       </div>
    </div><!--end row-->

     <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                  <h6 class="mb-0">Recent Booking</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Nb</th>
                          <th>Code</th>
                          <th>Booked Date</th>
                          <th>Customer</th>
                          <th>Room</th>
                          <th>Check IN/Out</th>
                          <th>Total Room</th>
                          <th>Guest</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($allData as $key=>$item)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td> <a href="{{route('edit.booking',$item->id)}}">{{ $item->code }} </a></td>
                      <td> {{ $item->created_at->format('d/m/Y') }} </td>
                      <td class="text-center"> {{ $item['user']['name'] }} </td>
                      <td> {{ $item['room']['type']['name'] }} </td>
                      <td class="text-center"> <span class="badge bg-success">{{ $item->check_in }}</span>  /<span class="badge bg-danger text-dark">{{ $item->check_out }}</span> </td>
                      <td class="text-center"> {{ $item->number_of_rooms }} </td>
                      <td class="text-center"> {{ $item->persons }} </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
        </div>
</div>

<script>
  var ctx = document.getElementById('bookingChart').getContext('2d');
  var bookings = @json($bookings);

  // Extract the required data from the bookings
  var labels = bookings.map(function(booking) {
      return booking.check_in; 
  });

  var data = bookings.map(function(booking) {
      return booking.total_price;
  });

  var bookingChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: 'Booking Data',
              data: data,
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>

@endsection