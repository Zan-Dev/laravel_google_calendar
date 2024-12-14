<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleCalendarService;

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
}
