<?php

namespace App\Http\Controllers\Dashboard;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Departments = Department::all();
        return  view ('Pages.Departments.index' , compact('Departments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $Department = new Department();
            $Department->name           = $request->name;
            $Department->title          = $request->title;

            $Department->save();

            return redirect()->route('Departments.index')->with('message','Data added Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $Department =  Department::findOrFail($request->id);
            $Department->name           = $request->name;
            $Department->title          = $request->title;

            $Department->save();

            return redirect()->route('Departments.index')->with('message','Data added Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        try {
            $Department = Department::findOrFail($request->id)->delete();

            return redirect()->route('Departments.index')->with('warning','Data delete Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
