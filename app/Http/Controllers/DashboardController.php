<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PartsRequest;
use App\User;
use Auth;

class DashboardController extends Controller
{
    
    public function index()
    {   
        
        return \View::make('dashboard');
        
    }

}
