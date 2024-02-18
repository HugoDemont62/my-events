<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    public function index()
    {
        $events = Event::where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->limit(4)
            ->get();
        $popularCategories = Category::withCount('events')
            ->orderBy('events_count', 'desc')
            ->take(4)
            ->get();

        return Inertia::render('Welcome', [
            'popularCategories' => $popularCategories,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'events' => $events,
        ]);
    }
}