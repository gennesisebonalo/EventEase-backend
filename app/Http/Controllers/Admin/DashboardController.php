<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::with(['venue', 'category'])->get();
        return view('admin.dashboard', compact('events'));
    }
}
