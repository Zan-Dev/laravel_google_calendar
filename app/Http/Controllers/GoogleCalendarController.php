<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleCalendarService;

// Try (can delete)
use Google\Client as GoogleClient;; 
use Google\Service\Calendar; 

class GoogleCalendarController extends Controller
{
    protected $googleService;    
	public function __construct(GoogleCalendarService $googleService)  {        
		$this->googleService = $googleService;    
	}    
	
	public function redirectToGoogle()  {        
		return redirect()->away($this->googleService->getClient()->createAuthUrl());    
	}    
	
	public function handleGoogleCallback(Request $request)  {        
		$this->googleService->authenticate($request->get('code'));        
		return redirect('/showEvents')->with('success', 'Google Calendar connected!');    
	} 

    public function showEvents() {    
        $events = $this->googleService->listEvents();    
        return view('dashboard', compact('events')); 
    }

	public function ListEvents(){

		if (!auth('web')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

		// Misalnya, data ini didapat dari Google Calendar API
        $client = new GoogleClient;
        $client->setAccessToken(auth('web')->user()->google_access_token); // Token Google
        $calendarService = new Calendar($client);

        // Ambil event dari Google Calendar
        $calendarId = 'primary'; // Kalender utama
        $events = $calendarService->events->listEvents($calendarId)->getItems();

        $formattedEvents = array_map(function ($event) {
            return [
                'summary' => $event->getSummary(),
                'start' => $event->getStart()->getDateTime() ?: $event->getStart()->getDate(),
            ];
        }, $events);

        return response()->json(['events' => $formattedEvents]);
	}
}
