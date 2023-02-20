<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index() {
        $offices = Office::orderBy('name')->with('user')->get();
        return inertia('Offices',compact('offices'));
    }
}
