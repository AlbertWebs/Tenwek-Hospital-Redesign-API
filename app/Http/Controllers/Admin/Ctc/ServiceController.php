<?php

namespace App\Http\Controllers\Admin\Ctc;

use App\Http\Controllers\Controller;
use App\Models\CtcService;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $items = CtcService::orderBy('order')->paginate(20);
        return view('admin.ctc.services.index', compact('items'));
    }
}
