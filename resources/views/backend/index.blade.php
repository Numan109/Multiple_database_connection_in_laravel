    @extends('layouts.admin_master')
    
    @section('main_content')
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl mx-auto p-6 lg:p-8">

                <div class="row  mt-5">
                    <div class="col-md-12 justify-content-md-center">
                        <h1 class="text-center"> Connected Database: {{$dbConnection}} </h1>
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-success btn-sm" onclick="change_database(this.value)" value="mysql" id="change_connection"> Switch School 1</button>
                        <button class="btn btn-success btn-sm"onclick="change_database(this.value)" value="school_1" id="change_connection"> Switch School 2</button>
                        <button class="btn btn-success btn-sm"onclick="change_database(this.value)" value="school_2" id="change_connection"> Switch School 3</button>
                    </div>
                </div>
                @foreach( $users as $row=>$values)
                <div class="row justify-content-md-center">
                    <div class="col-md-6 bg-primary mt-5 ">
                        <h1>{{$values->name}}</h1>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    @endsection

    @push('js')
    <script>
        let currentConnection = "{{$dbConnection}}";
      function change_database(name, id) {

        // console.log(name);
            axios.get("/change-db-connection", {
                params: {
                    // connection: (currentConnection === 'mysql' ? 'other' : 'mysql')
                    connection: name
                }
            }).then(() => location.reload());
        }
    </script>

    @endpush

