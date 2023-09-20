    @extends('layouts.admin_master')

    @section('main_content')

    <div class="card-body">

        <div class="row">

            @foreach($school_info as $row=>$values)

                <div class="dfd" style="float:left; margin-left:10px">

                    @php
                    $domain = $values->domain_name.'/auth/login';
                    @endphp

                    <form id="login" target="_blank" method="post" action="{{$domain}}">
                        <input type="hidden" name="username" value="viceprincipal" />
                        <input type="hidden" name="password" value="123456" />
                        <button type="submit" class="btn btn-success btn-xl" value="School Name">{{$values->school_name}}</button>
                    </form>
                </div>

            @endforeach



        </div>

        <hr>

        <div class="row table-responsive">
            <table id="datatable_all" class="table table-bordered  table-hover">
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


    </div>




    @endsection

    @push('js')
    <script>
        function change_database(name, id) {


            axios.get("/change-db-connection", {
                    params: {
                        // connection: (currentConnection === 'mysql' ? 'other' : 'mysql')
                        connection: name
                    }
                })
                .then((res) => {
                    console.log(res.data)

                })
                .catch((err) => {
                    console.log(err)
                })
        }
    </script>

<script>
        // Function to fetch data from the API using AJAX
        function fetchAPIData() {
            // $.ajax({
            // type: "GET",
            // url: "http://103.113.152.106/smart/footage/processed",
            // async: false,
            // success: function(response) {
            //     console.log(response);
            // }
            // });

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var apiData = JSON.parse(xhr.responseText);
                    console.log(apiData);
                    // Update the HTML with the fetched data
                    // document.getElementById('apiDataContainer').innerHTML = JSON.stringify(apiData, null, 2);
                }
            };
            xhr.open('GET', 'http://103.113.152.106/smart/footage/processed', true);
            xhr.send();
        }

        // Fetch data from the API when the page loads
        window.onload = function() {
            fetchAPIData();
        };
    </script>

    @endpush