<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        return view('salary.index');
    }
}
