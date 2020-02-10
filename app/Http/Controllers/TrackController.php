<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::mine();
        return view('tracks.index')
                ->with(compact('tracks'));
    }

    public function filter(\App\Education $education)
    {
        $tracks = Track::mine()->where('education_id', $education->id);
        return view('tracks.index')
                ->with(compact('tracks'))
                ->with(compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educations = \App\Education::mine();
        $track = new Track();
        return view('tracks.form')
                ->with(compact('educations'))
                ->with(compact('track'));
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
            'start'     => 'required|date',
            'end'       => 'required|date',
            'education' => 'required|min:1|in:' . \App\Education::mine()->implode('id', ',')
        ]);

        $track = new Track();
        $track->title = $request->title;
        $track->start = $request->start;
        $track->end = $request->end;
        $track->education_id = $request->education;
        $track->save();

        return redirect()->route('tracks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return "TODO; overzicht van de blokken in dit programma, waarbij ook duidelijk wordt of het aantal punten juist is, geijkt aan het totaal dat de opleiding moet hebben";
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        if(\Auth::user()->level < 3 && $track->education->unit_id != \Auth::user()->unit->id) return redirect()->back();
        $educations = \App\Education::mine();
        return view('tracks.form')
                ->with(compact('educations'))
                ->with(compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        if(\Auth::user()->level < 3 && $track->education->unit_id != \Auth::user()->unit->id) return redirect()->back();
        $this->validate(request(), [
            'title'     => 'required',
            'start'     => 'required|date',
            'end'       => 'required|date',
            'education' => 'required|min:1|in:' . \App\Education::mine()->implode('id', ',')
        ]);

        $track->title = $request->title;
        $track->start = $request->start;
        $track->end = $request->end;
        $track->education_id = $request->education;
        $track->save();

        return redirect()->route('tracks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        if(\Auth::user()->level < 3 && $track->education->unit_id != \Auth::user()->unit->id) return "forbidden";
        $track->delete();
        return "ok";
    }
}
