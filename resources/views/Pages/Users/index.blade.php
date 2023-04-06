@extends('layouts.master')

@section('title')
Users - Dashboard
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('title_page1')
{{trans('trans.Dashboard')}}
@endsection

@section('title_page2')
    {{trans('trans.Users')}}
@endsection

@section('content')

<?php  use App\User;    ?>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('trans.Users_Informations')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @can('Add_User')
                        <button style="margin-left: 12px; margin-top: 12px; width:120px;" type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                            {{trans('trans.Add_User')}}
                        </button>
                        @endcan

                        <div class="card-body">
                            <table id="example1"  class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{trans('trans.ID')}}</th>
                                    <th>{{trans('trans.Name')}}</th>
                                    <th>{{trans('trans.Roles')}}</th>
                                    <th>{{trans('trans.Email')}}</th>
                                    <th>{{trans('trans.Phone')}} </th>
                                    <th>{{trans('trans.Gender')}}</th>
                                    <th>{{trans('trans.Material_Status')}}</th>
                                    <th>{{trans('trans.Status')}}</th>
                                    <th>{{trans('trans.Photo')}}</th>
{{--                                    <th>Firstname</th>--}}
{{--                                    <th>Lastname</th>--}}
                                    <th style="width: 16%">{{trans('trans.Operations')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($Users as $User)
                                    @if($User->status == "Active")
                                    <tr>
                                    @else
                                        <tr style="background-color: #680505;color: white;">
                                    @endif
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{$User->name}}</td>
                                        <td>
                                                @if(!empty($User->getRoleNames()))
                                                    <ul>
                                                        @foreach($User->getRoleNames() as $v)
                                                            <li> <label >{{ $v }}</label> </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                        </td>
                                        <td>{{$User->email}}</td>
                                        <td>{{$User->phone}}</td>
                                        <td>{{$User->gender}}</td>
                                        <td>{{$User->material_status}}</td>
                                        <td>{{$User->status}}</td>
                                        <td><img src="{{$User->photo}}" width="40" height="40"></td>
{{--                                        <td>{{$User->firstname}}</td>--}}
{{--                                        <td>{{$User->lastname}}</td>--}}

                                        <td>
                                            @if($User->id != 1)
                                            @can('Update_User')
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{$User->id}}"
                                                    title=""><i class="fa fa-edit"></i></button>
                                            @endcan
                                                @can('Delete_User')
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{$User->id}}"
                                                    title=""><i
                                                    class="fa fa-trash"></i></button>
                                                @endcan
                                            @can('Activate_User')
                                            <button><a href="{{ route('Users.activate',['id'=>$User->id]) }}"><i class="fa-solid fa-retweet"></i></a></button>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>


                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{$User->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{trans('trans.Update_User')}}

                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <?php
                                                    $user = User::find($User->id);
                                                    $userRole = $user->roles->pluck('name','name')->all();
                                                    ?>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('Users.update', 'test') }}" enctype="multipart/form-data" method="post">
                                                        {{ method_field('put') }}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="firstname" class="mr-sm-2">{{trans('trans.Firstname')}}
                                                                    :</label>
                                                                <input id="firstname" type="text" name="firstname" class="form-control" value="{{$User->firstname}}" required>
                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$User->id}}">
                                                            </div>

                                                            <div class="col">
                                                                <label for="lastname" class="mr-sm-2">{{trans('trans.Lastname')}}
                                                                    :</label>
                                                                <input id="lastname" type="text" name="lastname" class="form-control" value="{{$User->lastname}}" required>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="name" class="mr-sm-2">{{trans('trans.Name')}}
                                                                    :</label>
                                                                <input id="name" type="text" name="name" class="form-control" value="{{$User->name}}" required>

                                                            </div>
                                                            <div class="col">
                                                                <label for="name" class="mr-sm-2">{{trans('trans.Password')}}
                                                                    :</label>
                                                                <input id="password" type="password" name="password" class="form-control" value="{{$User->password}}" required>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="email" class="mr-sm-2">{{trans('trans.Email')}}
                                                                    :</label>
                                                                <input id="email" type="email" name="email" class="form-control" value="{{$User->email}}" required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="phone" class="mr-sm-2">{{trans('trans.Phone')}}
                                                                    :</label>
                                                                <input id="phone" type="number" name="phone" class="form-control" value="{{$User->phone}}"  required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="phone" class="mr-sm-2">{{trans('trans.Gender')}}
                                                                    :</label>
                                                                <select id="gender" name="gender" class="form-select form-control" >
                                                                    <option selected value="Male">{{ trans('trans.Male') }}</option>
                                                                    <option value="Female">{{ trans('trans.Female') }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="phone" class="mr-sm-2">{{ trans('trans.Material_Status') }}
                                                                    :</label>
                                                                <select id="material_status" name="material_status" class="form-select form-control">
                                                                    <option selected value="Single">{{ trans('trans.Single') }}</option>
                                                                    <option value="Married">{{ trans('trans.Married') }}</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label  class="mr-sm-2">{{ trans('trans.Photo') }}</label>
                                                                <input type="file" name="photo" id="photo" style="width: 100%">

                                                            </div>
                                                            <div class="col">
                                                                <label for="phone" class="mr-sm-2">{{ trans('trans.Status') }}:</label>
                                                                <select id="status" name="status" class="form-select form-control">
                                                                    <option selected value="Active">{{ trans('trans.Active') }}</option>
                                                                    <option value="Inactive">{{ trans('trans.Inactive') }}</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                                <label for="inputSkills" class="col-sm-4 col-form-label">{{trans('trans.Roles')}}</label>
                                                                <div class="col-sm-8">
                                                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))
                                                                    !!}
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{trans('trans.Close')}}</button>
                                                            <button type="submit"
                                                                    class="btn btn-success">{{trans('trans.Submit')}}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $User->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{trans('trans.Delete_User')}}

                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('Users.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{trans('trans.Are_you_sure_delete')}}   <span style="    font-weight: bolder;">{{$User->name}} </span>?
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $User->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{trans('trans.Close')}}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{trans('trans.Submit')}}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{trans('trans.Add_User')}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('Users.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="firstname" class="mr-sm-2">{{trans('trans.Firstname')}}
                                        :</label>
                                    <input id="firstname" type="text" name="firstname" class="form-control" required>
                                </div>

                                <div class="col">
                                    <label for="lastname" class="mr-sm-2">{{trans('trans.Lastname')}}
                                        :</label>
                                    <input id="lastname" type="text" name="lastname" class="form-control" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="name" class="mr-sm-2">{{trans('trans.Name')}}
                                        :</label>
                                    <input id="name" type="text" name="name" class="form-control" required>

                                </div>
                                <div class="col">
                                    <label for="name" class="mr-sm-2">{{trans('trans.Password')}}
                                        :</label>
                                    <input id="password" type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                        <label for="email" class="mr-sm-2">{{trans('trans.Email')}}
                                            :</label>
                                        <input id="email" type="email" name="email" class="form-control" required>
                                    </div>
                                <div class="col">
                                    <label for="phone" class="mr-sm-2">{{trans('trans.Phone')}}
                                        :</label>
                                    <input id="phone" type="number" name="phone" class="form-control" required>
                                </div>
                          </div>

                            <div class="row">
                                <div class="col">
                                    <label for="phone" class="mr-sm-2">{{trans('trans.Gender')}}
                                        :</label>
                                    <select id="gender" name="gender" class="form-select form-control" >
                                        <option selected value="Male">{{ trans('trans.Male') }}</option>
                                        <option value="Female">{{ trans('trans.Female') }}</option>
                                    </select>

                                </div>
                                <div class="col">
                                    <label for="phone" class="mr-sm-2">{{ trans('trans.Material_Status') }}
                                        :</label>
                                    <select id="material_status" name="material_status" class="form-select form-control">
                                        <option selected value="Single">{{ trans('trans.Single') }}</option>
                                        <option value="Married">{{ trans('trans.Married') }}</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label  class="col-sm-2">{{ trans('trans.Photo') }}</label>
                                        <input type="file" name="photo" id="photo" style="width: 100%">

                                </div>
                                <div class="col">
                                    <label for="phone" class="mr-sm-2">{{ trans('trans.Status') }}:</label>
                                    <select id="status" name="status" class="form-select form-control">
                                        <option selected value="Active">{{ trans('trans.Active') }}</option>
                                        <option value="Inactive">{{ trans('trans.Inactive') }}</option>
                                    </select>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                    <label for="inputSkills" class="col-sm-4 col-form-label">{{trans('trans.Roles')}}</label>
                                    <div class="col-sm-8">
                                        {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                    </div>
                            </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{trans('trans.Close')}}</button>
                        <button type="submit" class="btn btn-success">{{trans('trans.Submit')}}</button>
                    </div>
                    </form>

                </div>
            </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>

        $(function () {

            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>


@endsection
