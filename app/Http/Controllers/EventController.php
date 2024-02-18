<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Category::all();
    $sortBy = $request->input('sort');

    if ($sortBy === 'startdate') {
        $events = Event::where('start_date', '>', now())
            ->orderBy('start_date', 'asc')->paginate(8);
    } elseif ($sortBy === 'minprice') {
        $events = Event::where('start_date', '>', now())
            ->orderBy('price', 'asc')->paginate(8);
    } elseif ($sortBy === 'maxprice') {
        $events = Event::where('start_date', '>', now())
            ->orderBy('price', 'desc')->paginate(8);
    } else {
        // Par défaut, récupérer les événements sans tri particulier
        $events = Event::where('end_date', '>', now())
            ->orderBy('end_date', 'asc') // Tri par date de fin par défaut
            ->paginate(8);
    }
    

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
        $event = new Event;
        $event->attribute_name = $request->input('attribute_name');
        $event->save();

        return Inertia::render('Events/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $isUserAttached = auth()->user()->isAttachedToEvent($event);
        $attachedCategories = $event->categories;

        $relatedEventIds = DB::table('category_event')
        ->whereIn('category_id', $attachedCategories->pluck('id'))
        ->where('event_id', '!=', $event->id)
        ->pluck('event_id')
        ->toArray();
        $relatedEvents = Event::where('start_date', '>', now())->whereIn('id', $relatedEventIds)->take(4)->get();
        $reviews = $event->reviews()->latest()->take(4)->get();
        $locations = Event::all()->where('location', $event->location)->take(4);

        return Inertia::render('Events/Show', [
            'event' => $event,
            'userId' => auth()->id(),
            'participants' => $event->users,
            'userName' => auth()->user(),   
            'isUserAttached' => $isUserAttached,
            'attachedCategories' => $attachedCategories,
            'relatedEvents' => $relatedEvents,
            'userCount' => $event->users->count(),
            'locations' => $locations,
            'isAuthenticated' => auth()->check(),
            'reviews' => $reviews,
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
