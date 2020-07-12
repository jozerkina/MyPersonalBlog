<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller
{
    // Middleware
    public function __construct() {
        // only Admin have access
        $this->middleware('admin');
    }

    public function __invoke() {
        return view('admin');
    } 
    
}