@extends('layouts.admin_master')
@push('css')
<style>
    .header_right {

        padding-right: 15px;
        padding-top: 5px;
    }
    .dark-mode input:-webkit-autofill{
        -webkit-text-fill-color: #000;
    }
</style>
@endpush
@section('main_content')


<div class="card-header">
    <div class="row">
        <div class="col-md-8">
            <h3><b>User Role</b></h3>
        </div>
        <div class="col-md-4 text-right header_right">
            @can('role.create')
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal_lg">Add Role</button>
            @endcan
            
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row table-responsive">

  
        <table id="datatable_only_search" class="table table-bordered  table-hover">
            <thead>

                <tr>
                    <th class="sl">Sl</th>
                    <th>Name</th>
                    <th class="action_2">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($user_role as $key=>$values)
                <tr>
                    <td class="sl">{{$key+1}}</td>
                    <td> {{$values->name}}</td>
                    <td class="action_2"> 

                        @can('role.edit')
                            <a href="{{url('user-role-edit') .'/'. $values->id}}" class="btn btn-success btn-sm">Edit</a>
                        @endcan

                        @can('role.delete')
                            <a href="{{route('user_role_delete',$values->id)}} " class="btn btn-danger btn-sm">Delete</a>
                        @endcan
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>


    </div>

</div>


<!-- Modal  -->
<div class="modal fade" id="modal_lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickForm" class="form" method="post" action="{{route('add_user_role')}}"  novalidate>
                    @csrf

                    <div class="card-body">
                    <div class="form-group">
                        <label for="add_name">Name</label>
                        <input  type="text" name="name" class="form-control text-default"  required autocomplete="off" id="add_name" placeholder="User Role">
                   
                        @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif


                    </div>
                    
                    
                    </div>
                    <!-- /.card-body -->
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            </form>
        </div>

    </div>

</div>

 <!--  End Modal -->

@endsection

@push('js')

@if (count($errors->all()) > 0)
    <script type="text/javascript">
        $( document ).ready(function() {
             $('#modal_lg').modal('show');
        });
    </script>
  @endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const forms = document.querySelectorAll('.form');
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
            }, false);
        });
    });
</script>
@endpush