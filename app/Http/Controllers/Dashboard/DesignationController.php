<?php

namespace App\Http\Controllers\Dashboard;

use App\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Designations = Designation::all();
        return  view ('Pages.Designations.index' , compact('Designations'));
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
            $Designation = new Designation();
            $Designation->name           = $request->name;
            $Designation->title          = $request->title;

            $Designation->save();

            return redirect()->route('Designations.index')->with('message','Data added Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
            ]);
            $Designation = Designation::findOrFail($request->id);
            $Designation->name           = $request->name;
            $Designation->title          = $request->title;

            $Designation->save();

            return redirect()->route('Designations.index')->with('message','Data added Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        try {
            $Designation = Designation::findOrFail($request->id)->delete();

            return redirect()->route('Designations.index')->with('warning','Data delete Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
