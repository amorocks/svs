<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show(\App\User $user = null)
    {
    	$user = $user ?? \Auth::user();
    	return $user;
    }
}
