 <x-layout>
	<h1>Google Calendar Events</h1>  
	@auth
		{{-- <h1>Masuk sebagai {{ auth('web')->user()->name }}</h1>   --}}
		<button onclick="window.location.href='{{ route('logout') }}'">Logout</button>
		
		@if(count($events) > 0)        
			<ul>
				@foreach($events as $event)
					<li>{{ $event->getSummary() }} ({{ $event->getStart()->getDateTime() }})</li>
				@endforeach
			</ul>
		@else
			<p>No events found.</p>
		@endif 
	@endauth
	
</x-layout>