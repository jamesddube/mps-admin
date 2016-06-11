@extends('layout.master')
        @section('title','OD2828')
        <!-- ======  HEADER  ===== -->
@section('content')
@if(count($order) > 0)
        <!-- begin invoice -->
<div class="invoice">
    <div class="invoice-company">
                    <span class="pull-right hidden-print">
                    <a href="javascript:;" class="btn btn-sm btn-success m-b-10"><i class="fa fa-download m-r-5"></i> Export as PDF</a>
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                    </span>
        {{ $order->customer }}
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <small>from</small>
            <address class="m-t-5 m-b-5">
                <strong>Mutare Bottling Company</strong><br />
                18 Riverside Drive<br />
                Mutare<br />
                Phone: (263) 63106<br />
                Fax: (123) 456-7890
            </address>
        </div>
        <div class="invoice-to">
            <small>to</small>
            <address class="m-t-5 m-b-5">
                <strong>{{ $order->customer }}</strong><br />
                {{ $order->address }}<br />
                City, Zip Code<br />
                {{ $order->telephone }}<br />
                Fax: (123) 456-7890
            </address>
        </div>
        <div class="invoice-date">
            <small>Invoice / July period</small>
            <div class="date m-t-5">{{ $order->created_at }}</div>
            <div class="invoice-detail">
                #{{ $order->id }}<br />
                Services Product
            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <thead>
                <tr>
                    <th>PRODUCT DETAILS</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>LINE TOTAL</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->lineItems as $item)
                <tr>
                    <td>
                        <i class="fa fa-apple m-r-10"></i>
                        <small>{{ $item->description }}</small>
                    </td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total_price }}</td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="invoice-price">
            <div class="invoice-price-left">
                <div class="invoice-price-row">
                    <div class="sub-price">
                        <small>SUBTOTAL</small>
                        $4,500.00
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>DISCOUNT (5.4%)</small>
                        $108.00
                    </div>
                </div>
            </div>
            <div class="invoice-price-right">
                <small>TOTAL</small> ${{ $order->total_price }}
            </div>
        </div>
    </div>
    <div class="invoice-note">
        * Make all cheques payable to [Your Company Name]<br />
        * Payment is due within 30 days<br />
        * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
    </div>
    <div class="invoice-footer text-muted">
        <p class="text-center m-b-5">
            THANK YOU FOR YOUR BUSINESS
        </p>
        <p class="text-center">
            <span class="m-r-10"><i class="fa fa-globe"></i> matiasgallipoli.com</span>
            <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
            <span class="m-r-10"><i class="fa fa-envelope"></i> rtiemps@gmail.com</span>
        </p>
    </div>
</div>
<!-- end invoice -->
@else
<p>
    <div class="jumbotron text-center text-danger">
        <h1>NO ENTRIES</h1>
<p>
    There are no entries no view here
</p>
</p>
@endif

    @endsection
    @section('footer')
    @parent

            <!-- ================== BEGIN PAGE LEVEL JS ================== -->

            <!-- ================== END PAGE LEVEL JS ==================== -->

@endsection


