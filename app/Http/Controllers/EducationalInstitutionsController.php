<?php

namespace App\Http\Controllers;
use App\Models\educational_institutions;

use Illuminate\Http\Request;

class EducationalInstitutionsController extends Controller
{
    public function index()
    {
        $institutions = educational_institutions::all();
        return response()->json($institutions);
    }
}
