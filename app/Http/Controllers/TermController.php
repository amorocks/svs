<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::mine();
        return view('terms.index')
                ->with(compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $term = new Term();
        $units = \App\Unit::mine();
        $rating_scales = \App\RatingScale::mine();
        return view('terms.form')
                ->with(compact('units'))
                ->with(compact('rating_scales'))
                ->with(compact('term'));
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
            'title'         => 'required',
            'unit'          => 'required|min:1|in:' . \App\Unit::mine()->implode('id', ','),
            'valid_from'    => 'required|date',
            'valid_to'      => 'nullable|date',
            'points'        => 'required|numeric',
            'rating_scale'  => 'required|min:1'
        ]);

        $term = new Term();
        $term->title = $request->title;
        $term->unit_id = $request->unit;
        $term->valid_from = $request->valid_from;
        $term->valid_to = $request->valid_to;
        $term->points = $request->points;
        $term->rating_scale_id = $request->rating_scale;
        $term->save();

        return redirect()->route('terms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        if(\Auth::user()->level < 3 && $term->unit_id != \Auth::user()->unit->id) return redirect()->back();
        $units = \App\Unit::mine();
        $rating_scales = \App\RatingScale::mine();
        return view('terms.form')
                ->with(compact('units'))
                ->with(compact('rating_scales'))
                ->with(compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        if(\Auth::user()->level < 3 && $term->unit_id != \Auth::user()->unit->id) return redirect()->back();
        $this->validate(request(), [
            'title'         => 'required',
            'unit'          => 'required|min:1|in:' . \App\Unit::mine()->implode('id', ','),
            'valid_from'    => 'required|date',
            'valid_to'      => 'nullable|date',
            'points'        => 'required|numeric',
            'rating_scale'  => 'required|min:1'
        ]);

        $term->title = $request->title;
        $term->unit_id = $request->unit;
        $term->valid_from = $request->valid_from;
        $term->valid_to = $request->valid_to;
        $term->points = $request->points;
        $term->rating_scale_id = $request->rating_scale;
        $term->save();

        return redirect()->route('terms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        if(\Auth::user()->level < 3 && $term->unit_id != \Auth::user()->unit->id) return "forbidden";
        $term->delete();
        return "ok";
    }
}
