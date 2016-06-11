@extends('layout.master')
@section('title','Customers')
@section('header')
@parent
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ url('assets/plugins/bootstrap-wizard/css/bwizard.min.css') }}" rel="stylesheet" />
<link href="{{ url('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
<link href="{{ url('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{ url('assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{ url('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="widget bg-black widget-customer">
                <i class="fa fa-behance fa-4x"></i>
                <span class="pull-right">{{ $customer->name }}</span>

            </div>

        </div>
        <div class="col-md-8">
            <div class="panel bg-grey">
                <div class="panel-body">


                </div>
            </div>
            <ul class="timeline">
                @foreach($customer->recentOrders as $order)
                <li>
                    <!-- begin timeline-time -->
                    <div class="timeline-time">
                        <span class="date">{{ $order->order_date }}</span>
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
                        <div class="timeline-header">
                            <span class="order">{{ $order->id }}</span>
                            <span class="pull-right orderTotal">$688</span>
                        </div>
                        <div class="timeline-footer">
                            <a href="javascript:;" class="m-r-15"><i class="fa fa-user fa-1x"></i></a>
                            <a href="javascript:;" class="m-r-15"><i class="fa fa-map-marker fa-1x"></i></a>
                            <a href="javascript:;" class="m-r-15"><i class="fa fa-gears fa-1x"></i></a>
                        </div>
                    </div>
                    <!-- end timeline-body -->
                </li>
                    @endforeach

            </ul>
            <!-- end timeline -->
        </div>
    </div>
@endsection
