@extends('layouts.admin_master')

@push('css')
<style>
    .main {
        height: 1000px;
        width: 60%;
        background-color: white;
        padding: 20px;
        color: #000;
        border: 1px solid;
        margin: auto;
    }

    .header {
        width: 100%;

        height: 120px;

    }

    .left_logo {
        height: 100%;
        width: 50%;
        float: left;


        /* padding: 0px 0px 0px 20px; */

    }

    .right_inv_info {
        width: 50%;
        padding: 20px;
        text-align: right;
        float: left;
        color: #000;
    }

    .right_inv_info p,
    h3,
    h4 {
        padding: 0px;
        margin: 0px;
    }

    .right_inv_info h3 {
        font-size: 18px;
        font-weight: bold;
    }

    .right_inv_info h4 {
        font-size: 16px;
        font-weight: bold;
    }

    .right_inv_info p {
        font-size: 13px;
        line-height: normal;
    }

    .address {
        height: 125px;
        width: 100%;
    }

    .left_address {
        width: 50%;
        float: left;
    }

    .right_address {
        width: 50%;
        float: left;
    }

    table {
        border-collapse: collapse;


    }


    th,
    td {
        padding: 2px 8px;
        text-align: left;

    }

    td {
        font-size: 14px;
        line-height: normal;
        border: 1px solid #000;
    }


    th {
        background-color: #727272;
        color: white;
    }
</style>
@endpush

@section('main_content')

@if($page_header!='')
<div class="card-header">
    <div class="row">
        <div class="col-md-8">
            <h3><b>{{$page_header}}</b></h3>
        </div>
        @if($add_button!='')
        <div class="col-md-4 text-right header_right">
            <!-- @can('role.create') -->
            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal_lg">{{$add_button}}</button>
            <!-- @endcan -->

        </div>
        @endif
    </div>
</div>

@endif

<div class="card-body">



    <div class="row">

        <div class="main">
            <div class="header">
                <div class="left_logo">
                    <img style="width:150px; height:150px;" src="{{asset('assets')}}/dist/img/devszone.png" alt="">
                </div>

                <div class="right_inv_info">
                    <h3>Invoice</h3>
                    <h4>{{$invoice->custom_invoice_id}}</h4>
                    <p> Invoice date : {{date('d-M-Y', strtotime($invoice->created_at))}} </p>
                    <p> Date : {{date('d-M-Y')}} </p>
                </div>


            </div>


            <div class="address">
                <div class="left_address">
                    <p style="padding: 0px 15px; margin:0px;">From:</p>
                    <div class="box" style=" width: 98%; height:80px; border:1px solid;padding:5px; background-color:antiquewhite">
                        <h4 style="padding-left: 10px; font-weight:bold;">DevsZone</h4>
                        <address style="padding:0px 10px 0px 10px; line-height:normal; font-size:13px;">

                            House-717, Road-10, Avenue-03, Mirpur DOHS,
                            Dhaka
                            1216 Dhaka
                        </address>
                    </div>

                </div>
                <div class="right_address">
                    <p style="padding: 0px 15px; margin:0px;"> To: </p>
                    <div class="box" style="float:right; width: 98%; height:80px; border:1px solid;padding:5px; ">
                        <h4 style="padding-left: 10px; font-weight:bold;"> BCSS</h4>
                        <address style="padding:0px 10px 0px 10px; line-height:normal; font-size:13px">

                            Road-10,, Mirpur 1,
                            Dhaka
                            1216 Dhaka

                        </address>
                    </div>


                </div>
            </div>

            <div class="main_table" style="width: 100%;">



                <table style="width: 100%;">
                    <thead>

                        <tr>
                            <th>school Name</th>
                            <th>Student</th>
                            <th>Gross Amount</th>
                            <th>Discount</th>
                            <th>Net Amount</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php
                        $total_student= 0;
                        $total_amount= 0;
                        @endphp
                        @foreach($invoice_with_details as $key=>$value)
                        <tr>

                            <td> {{$value->school_name}}</td>
                            <td>
                                {{$student = $value->student}}
                                @php $total_student+=$student @endphp
                            </td>

                            <td>
                                {{$value->g_amount}}

                            </td>
                            <td>
                                {{$value->id_discount}}

                            </td>
                            <td>
                                {{$amount = $value->id_net_amount}}

                                @php $total_amount+= $amount; @endphp
                            </td>

                        </tr>

                        @endforeach
                    </tbody>


                    <tfoot>

                        <tr>

                            <td colspan="3" style="text-align: right; border:0px;"></td>
                            <td style="text-align: right; "> Total :</td>
                            <td>{{$total_amount}} </td>

                        </tr>
                        <tr>

                            <td colspan="3" style="text-align: right; border:0px;"></td>
                            <td style="text-align: right; ">Status :</td>
                            <td>{{ucfirst($invoice->paid_status)}} </td>

                        </tr>

                    </tfoot>
                </table>

            </div>

            <div class="bank_info" style="width: 100%; margin-top:20px;">
                <address style="padding:0px 10px 0px 10px; line-height:normal; font-size:13px;">
                    <b>Payment by transfer to the following bank account:</b> <br>
                    <b>Bank: The City Bank </b><br>
                    <b> Account number: 1421643361001</b> <br>
                    Address: PALLABI <br>
                    Account owner name: DEVSZON
                </address>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- @can('role.edit') -->
                <a href="{{route('invoice.print',$invoice->id)}}" class="btn btn-success btn-sm">Print</a>
                <!-- @endcan -->
            </div>
        </div>


    </div>



    @endsection