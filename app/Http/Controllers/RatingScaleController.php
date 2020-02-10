<?php

namespace App\Http\Controllers;

use App\RatingScale;
use Illuminate\Http\Request;

class RatingScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rating_scales = RatingScale::mine();
        return view('rating_scales.index')
                ->with(compact('rating_scales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rating_scale = new RatingScale();
        return view('rating_scales.form')
                ->with(compact('rating_scale'));
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
            'global'    => 'nullable|boolean'
        ]);

        $rating_scale = new RatingScale();
        $rating_scale->title = $request->title;
        $rating_scale->unit_id = $request->global ? null : \Auth::user()->unit_id;
        $rating_scale->save();

        return redirect()->route('rating_scales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RatingScale  $rating_scale
     * @return \Illuminate\Http\Response
     */
    public function show(RatingScale $rating_scale)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RatingScale  $rating_scale
     * @return \Illuminate\Http\Response
     */
    public function edit(RatingScale $rating_scale)
    {
        if(\Auth::user()->level < 3 && $rating_scale->unit_id != \Auth::user()->unit->id) return redirect()->back();
        return view('rating_scales.form')
                ->with(compact('rating_scale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RatingScale  $rating_scale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RatingScale $rating_scale)
    {
        if(\Auth::user()->level < 3 && $rating_scale->unit_id != \Auth::user()->unit->id) return redirect()->back();
        $this->validate(request(), [
            'title'     => 'required',
            'global'    => 'nullable|boolean'
        ]);

        $rating_scale->title = $request->title;
        $rating_scale->unit_id = $request->global ? null : \Auth::user()->unit_id;
        $rating_scale->save();

        return redirect()->route('rating_scales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RatingScale  $rating_scale
     * @return \Illuminate\Http\Response
     */
    public function destroy(RatingScale $rating_scale)
    {
        if(\Auth::user()->level < 3 && $rating_scale->unit_id != \Auth::user()->unit->id) return "forbidden";
        $rating_scale->delete();
        return "ok";
    }
}
