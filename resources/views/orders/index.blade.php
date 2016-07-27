@extends('layout.master')
@section('title','Orders')
@section('header')

@parent
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ url('assets/plugins/bootstrap-wizard/css/bwizard.min.css') }}" rel="stylesheet"
      xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"
      xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml"/>
<link href="{{ url('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
<link href="{{ url('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{ url('assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css')}}" rel="stylesheet"/>
<link href="{{ url('assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')}}"
      rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
    @javascript('key',$orders)
    @javascript('token', csrf_token())

    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li class="active"><a href="#nav-pills-tab-1" data-toggle="tab">ALL ORDERS</a></li>
                <li><a href="#nav-pills-tab-2" data-toggle="tab">UNPROCESSED</a></li>
                <li><a href="#nav-pills-tab-3" data-toggle="tab">@{{ oi }}</a></li>
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
                                    <td data-toggle="collapse" data-target="#{{ $order->id }}">{{ $order->id }}</td>
                                    <td>{{ $order->customer }}</td>
                                    <td>{{ $order->sales_rep }}</td>
                                    <td><span class="label label-success">{{ $order->order_status }}</span></td>
                                    <td>Mutare</td>
                                    <td><a href="{{ url('orders/'.$order->id) }}" class="btn btn-sm btn-inverse">
                                            <i class="fa fa-search pull-left"></i>
                                            View
                                        </a>
                                        <div v-on:click="processOrder('{{ $order->id }}')" class="btn btn-sm btn-success">
                                           Process
                                        </div>

                                            <a class="btn btn-sm btn-success" href="javascript:;" id="add-sticky">Show</a>

                                    </td>
                                </tr>
                                <tr id="{{ $order->id }}" class="table collapse">
                                        <td>d</td>
                                        <td>d</td>
                                        <td>d</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        {!! $orders->render() !!}
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
                    <h4 class="modal-title">Process Order</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info m-b-0">
                        <h4><i class="fa fa-info-circle"></i> Alert Header</h4>
                        <p>nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
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

    <script src="{{ url('assets/js/apps.min.js') }}"></script>
    <script src="{{ url('assets/js/vue.js') }}"></script>
    <script src="{{ url('assets/js/vue-router.min.js') }}"></script>
    <script src="{{ url('assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ url('assets/js/ui-modal-notification.demo.min.js')}}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        new Vue({
            ready:function () {
                Notification.init();

            },
            el: '#data-table',
            methods: {
                greet: function (msg) {
                    this.$http.post('api/check');

                    //alert(msg);
                },
                processOrder: function (id) {
                    $.ajax({
                        url: 'orders/process',
                        type: 'post',
                        data:{
                            _token:token,
                            id:id
                        },
                        dataType: 'json',
                        async: true,
                        success: function (data) {

                            console.log(data.message);
                            location.reload()

                        }
                    });
                },
                fetchOrder: function (order) {
                    $.ajax({
                        url: 'api/orders/'+ order,
                        type: 'get',
                        dataType: 'json',
                        async: false,
                        success: function (data) {

                            alert(data.id);

                        }
                    });
                }
            }
        });
    console.log(token)
    </script>

@endsection
