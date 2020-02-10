<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', 'teacher')->get();
        return view('users.index')
                ->with(compact('users'));
    }

    public function filter(\App\Unit $unit)
    {
        $users = User::where('type', 'teacher')->where('unit_id', $unit->id)->get();
        return view('users.index')
                ->with(compact('users'))
                ->with(compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $units = \App\Unit::all();
        return view('users.edit')
                ->with(compact('units'))
                ->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'level' => 'required',
            'unit' => 'required'
        ]);

        $user->level = $request->level;
        $user->unit_id = $request->unit;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return "ok";
    }
}
