<?php

namespace App\Http\Controllers;
use App\Models\Careers;

use Illuminate\Http\Request;

class CareersController extends Controller
{
     public function index()
    {
        $careers = Careers::all();
        return response()->json($careers);
    }
}
