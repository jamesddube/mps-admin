@extends('layout.master')
@section('title','Products')
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
                        <th>Product ID</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr class="odd gradeX">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category }}</td>
                        <td><span class="label label-success">{{ $product->price }}</span></td>
                        <td><a href="{{ url('products/'.$product->id) }}" class="btn btn-sm btn-inverse">
                                <i class="fa fa-search pull-left"></i>
                                View<br />
                            </a></td>
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
