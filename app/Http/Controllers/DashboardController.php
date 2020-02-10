<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
    	$students = \Auth::user()->students;
    	return view('dashboard.home')
    			->with(compact('students'));
    }

    public function unit()
    {
    	
    	if(\Auth::user()->level < 3)
    	{
    		session()->flash("status", ["danger" => "Je bent nog geen lid van een team, vraag een admin om je toe te voegen."]);
    		return view('layouts.app');
    	} 
    	elseif(\Auth::user()->level >= 3)
    	{
    		session()->flash("status", ["danger" => "Je bent nog geen lid van een team, voeg jezelf toe."]);
    		return redirect()->route('users.edit', \Auth::user());
    	}
    }
}
