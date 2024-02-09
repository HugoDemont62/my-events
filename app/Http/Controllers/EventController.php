<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('end_date', '>', now())->paginate(8);
        $categories = Category::all();

        return Inertia::render('Events/Index', [
            'events' => $events,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $event = new Event;
        $event->attribute_name = $request->input('attribute_name');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->save();

        return Inertia::render('Events/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $isUserAttached = false;
        if (auth()->check()) {
            $isUserAttached = auth()->user()->isAttachedToEvent($event);
        }

        $attachedCategories = $event->categories;
        $relatedEventIds = $event->categories->pluck('events')->flatten()->pluck('id')->toArray();
        $relatedEvents = Event::where('start_date', '>', now())->whereIn('id', $relatedEventIds)->get();
        $locations = Event::all()->where('location', $event->location)->take(4);

        return Inertia::render('Events/Show', [
            'event' => $event,
            'userId' => auth()->id(),
            'participants' => $event->users,
            'isUserAttached' => $isUserAttached,
            'attachedCategories' => $attachedCategories,
            'relatedEvents' => $relatedEvents,
            'userCount' => $event->users->count(),
            'locations' => $locations,
            'isAuthenticated' => auth()->check(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->attribute_name = $request->input('attribute_name');
        $event->save();

        return Inertia::render('Events/Index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return Inertia::render('Events/Index');
    }
}
