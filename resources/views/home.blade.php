@extends('layouts.master')

@section('title')
    {{ trans('trans.Dashboard') }}
@stop

@section('css')

@endsection

@section('title_page1')
    {{ trans('trans.Main') }}
@endsection

@section('title_page2')
    {{ trans('trans.Dashboard') }}
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$Users}}</h3>

                            <p>{{trans('trans.Users')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('Users.index')}}" class="small-box-footer">{{trans('trans.Go_to_Link')}} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                    <div class="col-md-6">
                        <h5>{{ trans('trans.Percentage_of_users') }}</h5>
                        <div style="width:100%;">
                            {!! $chartjs1->render() !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>{{ trans('trans.Percentage_of_users') }}</h5>
                        <div style="width:100%;">
                            {!! $chartjs2->render() !!}
                        </div>
                    </div>
                    <br> <br>
                    <div class="col-md-6">
                        <h5>{{ trans('trans.Percentage_of_users') }}</h5>
                        <div style="width:100%;">
                            {!! $chartjs3->render() !!}
                        </div>
                    </div>
                </div>

            <br> <br>


        </div><!-- /.container-fluid -->


    </section>
    <!-- /.content -->
@endsection


@section('scripts')

@endsection

