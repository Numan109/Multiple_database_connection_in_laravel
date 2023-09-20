@extends('layouts.admin_app')

@push('css')
<style>
    .main {

        width: 100%;
        background-color: white;
        padding: 20px;
        color: #000;
        /* border: 1px solid; */
        margin: auto;
        min-height: 750px;
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

    @page {
        size: landscape;
        size: A4;
        margin: 0mm;
    }

    @page {
        size: landscape;
    }

    @media print {
        body {
            -webkit-print-color-adjust: exact;
        }
    }

    .middle_line {
        background-color: #fff;
        border-left: 2px dotted #444;
        height: 500px;
    }
</style>
@endpush

@section('main_section')


<div class="card-body">



    <div class="row">

        <div class="left" style="width: 49%; float:left;">
            <div class="main">
                <div class="header">
                    <div class="left_logo">
                        <p style="position: absolute; width:25%; text-align:right">Office coppy</p>
                        <img style="width:150px; height:150px; margin-top: -15px;" src="{{asset('assets')}}/dist/img/devszone.png" alt="">
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
                                <td>school Name</td>
                                <td>Student</td>
                                <td>Gross Amount</td>
                                <td>Discount</td>
                                <td>Net Amount</td>
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
        </div>

        <div class="middle" style="width: 2%; float:left; display: grid; place-items: center;background-color: #fff;">
            <div class="middle_line"></div>
        </div>

        <div class="right" style="width: 49%; float:left;">
            <div class="main">
                <div class="header">
                    <div class="left_logo">
                        <p style="position: absolute; width:25%; text-align:right">User coppy</p>
                        <img style="width:150px; height:150px; margin-top: -15px;" src="{{asset('assets')}}/dist/img/devszone.png" alt="">
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
                        <div class="box1" style=" width: 98%; height:80px; border:1px solid;padding:5px; background-color:antiquewhite">
                            <h4 style="padding-left: 10px; font-size:20px; font-weight:bold;">DevsZone</h4>
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
                                <td>school Name</td>
                                <td>Student</td>
                                <td>Gross Amount</td>
                                <td>Discount</td>
                                <td>Net Amount</td>
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
        </div>



    </div>



    @endsection

    @push('js')

    <script>
        $(document).ready(function() {
            setTimeout(function() {

                window.location.href = 'http://127.0.0.1:8000/view-invoice/{{$invoice->id}}'

            }, 2000);
            document.title = '<?php echo '#' . $invoice->custom_invoice_id . '_'; ?>';
            window.print();


        })
        // window.addEventListener("load",

        // document.title= '<?php echo '#' . $invoice->custom_invoice_id . '_'; ?>',
        //         window.print()

        // );
    </script>

    @endpush