@extends('layouts.master')


@section('title')
    Push Notification - Dashboard
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
    {{trans('trans.Push_Notification')}}
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('trans.Push_Notification')}}</h3>
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
                        @can('Add_Push_Notification')
                            <button style="margin-left: 12px; margin-top: 12px; width:150px;" type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                                {{trans('trans.Push_Notification')}}
                            </button>
                        @endcan
                        <div class="card-body">
                            <table id="example1"  class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th> {{trans('trans.ID')}} </th>
                                    <th>{{trans('trans.title')}}  </th>
                                    <th>{{trans('trans.body')}} </th>
                                    <th>{{trans('trans.User')}} </th>
                                    <th>{{trans('trans.Created_At')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($Pushnotifications as $Pushnotification)
                                    <tr>
                                         <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{$Pushnotification->title}}</td>
                                        <td>{{$Pushnotification->body}}</td>
                                        <td>{{$Pushnotification->users->name}}</td>
                                        <td>{{$Pushnotification->created_at}}</td>
                                    </tr>
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


        <!-- add_modal_Notifications -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{trans('trans.Push_Notification')}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('pushNotification') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="firstname" class="mr-sm-2"> {{trans('trans.title')}}
                                        :</label>
                                    <input id="title" type="text" name="title" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="lastname" class="mr-sm-2">{{trans('trans.body')}}
                                        :</label>
                                    <input id="body" type="text" name="body" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <label for="email" class="mr-sm-2">{{trans('trans.Users')}}
                                    :</label>
                                <select id="users" name="users[]" class="form-select form-control" multiple>
                                    @foreach($Users as $User)
                                        <option value="{{$User->id}}">{{ $User->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{trans('trans.Close')}} </button>
                        <button type="submit" class="btn btn-success">{{trans('trans.Submit')}}</button>
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

    </section>


    <!-- /.content -->
@endsection




@section('scripts')
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
