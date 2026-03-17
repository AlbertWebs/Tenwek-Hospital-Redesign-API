<?php

namespace App\Http\Controllers\Admin\Ctc;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ClinicController extends Controller
{
    public function index(): View
    {
        return view('admin.ctc.clinics.index');
    }
}
