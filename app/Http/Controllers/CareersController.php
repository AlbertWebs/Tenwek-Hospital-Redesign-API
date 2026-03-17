<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\View\View;

class CareersController extends Controller
{
    public function index(): View
    {
        $jobs = Career::published()
            ->open()
            ->orderBy('closing_date', 'asc')
            ->orderBy('order')
            ->get();
        return view('careers.index', compact('jobs'));
    }
}
