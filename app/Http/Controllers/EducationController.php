<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::all();
        return view('educations.index')
                ->with(compact('educations'));
    }

    public function filter(\App\Unit $unit)
    {
        $educations = Education::where('unit_id', $unit->id)->get();
        return view('educations.index')
                ->with(compact('educations'))
                ->with(compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $education = new Education();
        $units = \App\Unit::all();
        return view('educations.form')
                ->with(compact('units'))
                ->with(compact('education'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title'     => 'required',
            'crebo'     => 'required|numeric',
            'unit'      => 'required|min:1',
            'points'    => 'required|numeric'
        ]);

        $education = new Education();
        $education->title = $request->title;
        $education->crebo = $request->crebo;
        $education->unit_id = $request->unit;
        $education->points = $request->points;
        $education->save();

        return redirect()->route('educations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        $units = \App\Unit::all();
        return view('educations.form')
                ->with(compact('units'))
                ->with(compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        $this->validate(request(), [
            'title'     => 'required',
            'crebo'     => 'required|numeric',
            'unit'      => 'required|min:1',
            'points'    => 'required|numeric'
        ]);

        $education->title = $request->title;
        $education->crebo = $request->crebo;
        $education->unit_id = $request->unit;
        $education->points = $request->points;
        $education->save();

        return redirect()->route('educations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $education->delete();
        return "ok";
    }
}
