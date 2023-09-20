@extends('layouts.admin_master')

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
    
        <div class="row table-responsive">
            <table id="datatable_all" class="table table-bordered  table-hover">
                <thead>
                    <tr>
                        <th class="">Invoice Id</th>
                        <th>Bill Month</th>
                        <th>Total Student</th>
                        <th>Gross Amount</th>
                        <th>Net Amount</th>
                        <th>Paid Status</th>
                        <th class="action_1">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $key=>$invoice)
                    <tr>
                        <td>{{$invoice->custom_invoice_id}}</td>
                        <td>{{date('M, Y',strtotime('01-'.$invoice->date))}}</td>
                        <td>{{$invoice->total_student}}</td>
                        <td>{{$invoice->gross_amount}}</td>
                        <td>{{$invoice->net_amount}}</td>
                        <td>{{$invoice->paid_status}}</td>
                        <td class="action_1">

                            <!-- @can('role.edit') -->
                            <a href="{{route('invoice.view',$invoice->id)}}" class="btn btn-success btn-sm">View</a>
                            <!-- @endcan -->
                            <!-- @can('role.edit') -->
                            <!-- <a href="#" class="btn btn-primary btn-sm">Pay</a> -->
                            <!-- @endcan -->

                            <!-- @can('role.delete') -->
                            <!-- <a href="# " class="btn btn-danger btn-sm">Delete</a> -->
                            <!-- @endcan -->
                        </td>
                    </tr>

                    @endforeach

                </tbody>


            </table>


        </div>

    </div>



    @endsection