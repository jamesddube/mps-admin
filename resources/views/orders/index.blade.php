@extends('layout.master')
@section('title','Orders')
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
        <!-- begin col-12 -->
        <div class="col-md-12">
        <ul class="nav nav-pills">
            <li class="active"><a href="#nav-pills-tab-1" data-toggle="tab">ALL ORDERS</a></li>
            <li><a href="#nav-pills-tab-2" data-toggle="tab">UNPROCESSED</a></li>
            <li><a href="#nav-pills-tab-3" data-toggle="tab">Pills Tab 3</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="nav-pills-tab-1">
                <div class="m-20">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Sales Rep</th>
                        <th>Status</th>
                        <th>Route</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    <tr class="odd gradeX">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer }}</td>
                        <td>{{ $order->sales_rep }}</td>
                        <td><span class="label label-success">{{ $order->order_status }}</span></td>
                        <td>Mutare</td>
                        <td><a href="{{ url('orders/'.$order->id) }}" class="btn btn-sm btn-inverse">
                                <i class="fa fa-search pull-left"></i>
                                View<br />
                            </a>
                            <a href="#modal-alert" class="btn btn-sm btn-success" data-toggle="modal">
                                <i class="fa fa-cog pull-left"></i>
                                Process<br />
                            </a>
                            <a href="#modal-alert" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-cog pull-left"></i>Process</a>

                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                </p>
            </div>
                </div>
            <div class="tab-pane fade" id="nav-pills-tab-2">

                <p>
                   <div class="jumbotron text-center text-danger">
                    <h1>NO ENTRIES</h1>
                    <p>
                    There are no entries no view here
                </p>
                </div>
                </p>
            </div>
            <div class="tab-pane fade" id="nav-pills-tab-3">
                <h3 class="m-t-10">Nav Pills Tab 3</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor,
                    est diam sagittis orci, a ornare nisi quam elementum tortor.
                    Proin interdum ante porta est convallis dapibus dictum in nibh.
                    Aenean quis massa congue metus mollis fermentum eget et tellus.
                    Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien,
                    nec eleifend orci eros id lectus.
                </p>
            </div>
        </div>
    </div>

    <!-- #modal-alert -->
    <div class="modal fade" id="modal-alert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Alert Header</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger m-b-0">
                        <h4><i class="fa fa-info-circle"></i> Alert Header</h4>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Action</a>
                </div>
            </div>
        </div>
    </div>
                       


    @endsection

    @section('footer')
    @parent

            <!-- ================== BEGIN PAGE LEVEL JS ================== -->
            <script src="{{ url('assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
            <script src="{{ url('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
            <script src="{{ url('assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js') }}"></script>
            <script src="{{ url('assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ url('assets/js/table-manage-select.demo.min.js') }}"></script>
            <script src="{{ url('assets/js/apps.min.js') }}"></script>
            <script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
            <script src="assets/js/ui-modal-notification.demo.min.js"></script>
            <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            TableManageTableSelect.init();
            $('#status')
            {

            }
            });
    </script>
@endsection
