<?php

namespace App\Http\Controllers\Admin\Ctc;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(): View
    {
        return view('admin.ctc.facilities.index');
    }
}
