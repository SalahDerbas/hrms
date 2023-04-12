@extends('layouts.master')

@section('title')
    Departments - Dashboard
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
    {{trans('trans.Departments')}}
@endsection

@section('content')




        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('trans.Departments_Informations')}}</h3>
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

                        @can('Add_Department')
                            <button style="margin-left: 12px; margin-top: 12px; width:160px;" type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                                {{trans('trans.Add_Department')}}
                            </button>
                        @endcan

                        <div class="card-body">
                            <table id="example1"  class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{trans('trans.ID')}}</th>
                                    <th>{{trans('trans.Name')}}</th>
                                    <th>{{trans('trans.Title')}}</th>
                                    <th style="width: 16%">{{trans('trans.Operations')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                @foreach ($Departments as $Department)
                                        <tr>
                                                <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{$Department->name}}</td>
                                            <td>{{$Department->title}}</td>

                                            <td>
                                                    @can('Update_Department')
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#edit{{$Department->id}}"
                                                                title=""><i class="fa fa-edit"></i></button>
                                                    @endcan
                                                    @can('Delete_Department')
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#delete{{$Department->id}}"
                                                                title=""><i
                                                                class="fa fa-trash"></i></button>
                                                    @endcan
                                            </td>
                                        </tr>


                                        <!-- edit_modal_Grade -->
                                        <div class="modal fade" id="edit{{$Department->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            {{trans('trans.Update_Department')}}

                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form action="{{ route('Departments.update', 'test') }}" enctype="multipart/form-data" method="post">
                                                            {{ method_field('put') }}
                                                            @csrf
                                                            <div class="row">
                                                                    <label for="firstname" class="mr-sm-2">{{trans('trans.Name')}}
                                                                        :</label>
                                                                    <input id="name" type="text" name="name" class="form-control" value="{{$Department->name}}" required>
                                                                    <input id="id" type="hidden" name="id" class="form-control" value="{{$Department->id}}">


                                                            </div>
                                                            <div class="row">
                                                                    <label for="name" class="mr-sm-2">{{trans('trans.Title')}}
                                                                        :</label>
                                                                <textarea id="title" name="title" class="form-control">{{$Department->title}}</textarea>

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
                                        <div class="modal fade" id="delete{{ $Department->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            {{trans('trans.Delete_Department')}}

                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('Departments.destroy', 'test') }}" method="post">
                                                            {{ method_field('Delete') }}
                                                            @csrf
                                                            {{trans('trans.Are_you_sure_delete')}}   <span style="    font-weight: bolder;">{{$Department->name}} </span>?
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $Department->id }}">
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
                            {{trans('trans.Add_Department')}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('Departments.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <label for="firstname" class="mr-sm-2">{{trans('trans.Name')}}
                                    :</label>
                                <input id="name" type="text" name="name" class="form-control" required>


                            </div>
                            <div class="row">
                                <label for="name" class="mr-sm-2">{{trans('trans.Title')}}
                                    :</label>
                                <textarea id="title" name="title" class="form-control"></textarea>

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
