<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setting()
    {
        return view ('Pages.Settings.index');
    }
    public function index()
    {

        $Users = User::count();
        $count_all = User::count();
        $count_active = User::where(['status' => 'Active'])->count();
        $count_inactive = User::where(['status' => 'Inactive'])->count();

        if($count_active == 0)
        {
            $active = 0;
        }
        else
        {
            $active= $count_active/$count_all*100;
        }
        if($count_inactive == 0)
        {
            $inactive = 0;
        }
        else
        {
            $inactive = $count_inactive/$count_all*100;
        }

        // ExampleController.php
        $chartjs1 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['User Active', 'User Inactive'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => [$active, $inactive]
                ]
            ])
            ->options([]);


        $chartjs2 = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Users'])
            ->datasets([
                [
                    "label" => "User Active",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$active]
                ],
                [
                    "label" => "User Inactive",
                    'backgroundColor' => ['#36a2eb'],
                    'data' => [$inactive]
                ]
            ])
            ->options([]);

        $chartjs3 = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Users','Users'])
            ->datasets([
                [
                    "label" => "Active",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [0,$active],
                ],
                [
                    "label" => "Inactive",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [0,$inactive],
                ],

            ])
            ->options([]);

        return view('home', compact('chartjs1' , 'chartjs2','chartjs3' , 'Users'));
    }
}
