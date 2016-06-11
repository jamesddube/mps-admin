@extends('layout.master')
@section('title','Customers')
@section('header')
@parent
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ url('assets/plugins/bootstrap-wizard/css/bwizard.min.css') }}" rel="stylesheet"/>
<link href="{{ url('assets/css/customer.css') }}" rel="stylesheet"/>
<link href="{{ url('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="widget bg-white customer-profile text-center">
                <div class="profile-header"
                     style="background-image: url({{ url('assets/img/triangular.svg') }});background-size:cover ">
                    <div class="image">
                        <span class="customer-title">{{ $user->name }}</span>
                    </div>
                </div>
                <div class="profile-footer">
                    <div class="row">
                        <div class="col-sm-3">
                            <span class="stats-title">Weekly Sales</span>
                            <p class="fa-2x">34K</p>
                            <span><small><i class="fa fa-arrow-up text-success fa-fw"></i> 3%</small></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="stats-title">Average</span>
                            <p class="fa-2x">370</p>
                            <span><small>cases/load</small></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="stats-title">Yesterday's Order</span>
                            <p class="fa-2x">520</p>
                            <span><small><i class="fa fa-star text-success fa-fw"></i><i
                                            class="fa fa-star text-success fa-fw"></i><i
                                            class="fa fa-star text-success fa-fw"></i><i
                                            class="fa fa-star text-success fa-fw"></i></small></span>
                        </div>
                        <div class="col-sm-3">
                            <span class="stats-title">YTD Sales</span>
                            <p class="fa-2x">67K</p>
                            <span><small><i class="fa fa-arrow-up text-success fa-fw"></i> 6.7%</small></span>
                        </div>
                    </div>

                </div>


            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-heading panel-primary">
                  <span class="panel-icon">
                    <i class="fa fa-book"></i>
                  </span>
                            <span class="panel-title">About <b>{{ $user->name }}</b></span>
                        </div>
                        <div class="panel-body pb5">


                            <div class="row text-center">
                                <div class="col-sm-6">
                                    <h6>Customer Type</h6>
                                    <h4>
                                        <div class="badge badge-default">{{ $user->customer_type }}</div>
                                    </h4>
                                </div>
                                <div class="col-sm-6">
                                    <h6>Customer State</h6>
                                    <h4>
                                        <div class="badge badge-default">{{ $user->customer_status }}</div>
                                    </h4>
                                </div>
                            </div>
                            <hr class="short br-lighter">
                            <h6>Contact Details</h6>

                            <h4>{{ $user->city }}</h4>
                            <p class="text-muted">
                                {{ $user->address }}
                            </p>

                            <hr class="short br-lighter">
                            <div>
                                <h6>Promotions</h6>

                                <h4>Active Promotions
                                    <div class="badge badge-danger pull-right">7</div>
                                </h4>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="panel-heading panel-primary">
                  <span class="panel-icon">
                    <i class="fa fa-book"></i>
                  </span>
                            <span class="panel-title"><b>Order Timeline</b></span>
                        </div>

                        <!-- begin timeline -->
                        @foreach($user->orders as $order)
                        <ul class="timeline">
                            <li>
                                <!-- begin timeline-time -->
                                <div class="timeline-time">
                                    <span class="date">{{ $order->date }}</span>
                                    <span class="time">04:20</span>
                                </div>
                                <!-- end timeline-time -->
                                <!-- begin timeline-icon -->
                                <div class="timeline-icon">
                                    <a href="javascript:;"><i class="fa fa-paper-plane"></i></a>
                                </div>
                                <!-- end timeline-icon -->
                                <!-- begin timeline-body -->
                                <div class="timeline-body">
                                    <div class="timeline-content">
                                                <div class="widget widget-stats bg-green-darker">
                                                    <div class="row text-center">
                                                        <div class="col-md-4">
                                                            <div class="stats-title">Total</div>
                                                            <div class="stats-number">{{ $order->total_quantity }}</div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="stats-title">Customers</div>
                                                            <div class="stats-number">5</div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="stats-title"><img src="{{ url('assets/img/user-2.jpg') }}" ></div>
                                                        </div>
                                                        <div class="stats-desc badge badge-info text-left">RUSAPE</div>

                                                    </div>

                                                </div>
                                            </div>
                                </div>
                                <!-- end timeline-body -->
                            </li>
                            @endforeach


                        </ul>
                        <!-- end timeline -->
                    </div>

                </div>
            </div>
        </div>


    </div>

    </div>
    @endsection
    @section('footer')
    @parent
            <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{url('assets/plugins/switchery/switchery.min.js')}}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endsection
