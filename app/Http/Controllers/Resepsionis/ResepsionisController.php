<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResepsionisController extends Controller
{
    public function index(): View
    {
        return view('content.resepsionis.dashboard');
    }
}
