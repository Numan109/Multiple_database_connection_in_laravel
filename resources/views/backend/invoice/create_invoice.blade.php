@extends('layouts.admin_master')
@push('css')
<style>

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
    <form method="post" action="{{route('active_student_for_invoice')}}">
        @csrf
        <div class="row">

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Select Month</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">--Select Month--</option>
                        @foreach(getMonth() as $key=>$month)
                        <option value="{{ $key }}" {{ $selected_month == $key ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-4 ">
                <button type="submit" class="  btn btn-sm btn-primary find_button">Find</button>
            </div>
        </div>

    </form>

    <hr>

    @if($data)
    <div class="row table-responsive">

        <table id="nodatatabel" class="table table-bordered  table-hover">
            <thead>

                <tr>
                    <th class="sl">Sl</th>
                    <th>school Name</th>
                    <th>Student</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

                @php
                $total_student= 0;
                $total_amount= 0;
                @endphp
                @foreach($data as $key=>$values)
                <tr>
                    <td class="sl">{{$key+1}}</td>
                    <td> {{$values->school_name}}</td>
                    <td>
                        {{$student = $values->total}}
                        @php $total_student+=$student @endphp
                    </td>
                    <td>
                        {{$amount = $values->total*12}}

                        @php $total_amount+= $amount; @endphp
                    </td>

                </tr>

                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="2" class="text-center">Total </th>
                    <th>{{$total_student}} </th>
                    <th>{{$total_amount}} </th>

                </tr>
            </tfoot>
        </table>


    </div>

    <div class="col-md-12 text-right">
        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal_lg" > Create Invoice</button>
    </div>

    


    @endif

</div>




@endsection

@push('js')

<script>

</script>
@endpush