    @extends('layouts.admin_master')

    @section('main_content')

    <div class="row">

        <div class="col-md-3" onclick="change_database('mysql')">
            <div class="card">
                <div class="card-body">
                    All School
                </div>
            </div>
        </div>

        <div class="col-md-3" onclick="change_database('school_1')">
            <div class="card">
                <div class="card-body">
                    School 1
                </div>
            </div>
        </div>
        <div class="col-md-3" onclick="change_database('school_2')">
            <div class="card">
                <div class="card-body">
                    School 2
                </div>
            </div>
        </div>
    </div>



    <div class="row table-responsive">
        <table id="datatable_2" class="table table-bordered  table-hover">
            <thead>
                <tr>
                    <th colspan="14" style="text-align: center;">All School Active Students - {{$year}}</th>

                </tr>
                <tr>
                    <th>Sl</th>
                    <th>School Name</th>
                    @foreach($months as $row=>$month)
                    <th>{{$month}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                $sl=1;
                $total=[];
                @endphp

                @foreach( $all_school_active_student as $name=>$values)

                <tr>
                    <td>{{$sl++}}</td>
                    <td>{{$name}}</td>
                    @foreach($months as $row=>$month)

                    <td>
                        @foreach( $values as $key=>$data)
                        @if(($row+1) == $data->month)
                        {{ $data->total }}

                        @php $total[$data->month][]=$data->total; @endphp
                        @endif
                        @endforeach
                    </td>

                    @endforeach
                </tr>

                @endforeach


            </tbody>


            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: center;">Total</td>

                    @foreach($months as $row=>$month)
                    <td>


                        <?php $all_school_all_month_total_students = []; ?>

                        @foreach($total as $key=>$val)

                        <?php $all_school_all_month_total_students[$key] = array_sum($val) ?>

                        @endforeach

                        @foreach($all_school_all_month_total_students as $key=>$value)

                        @if(($row+1) == $key)
                        {{ $value }}
                        @endif

                        @endforeach

                    </td>
                    @endforeach
                </tr>
            </tfoot>
        </table>


    </div>






    @endsection

    @push('js')
    <script>
        function change_database(name, id) {

            console.log(name);
            axios.get("/change-db-connection", {
                params: {
                    // connection: (currentConnection === 'mysql' ? 'other' : 'mysql')
                    connection: name
                }
            }).then(() => location.reload());
        }
    </script>

    @endpush