 <x-layout>
	<h1>Google Calendar Events</h1>  
	
	@auth
		<button onclick="window.location.href='{{ route('logout') }}'">Logout</button>
		<h1>Youre Login With {{ auth('web')->user()->name }}</h1>		
		
		<button id="loadCalendar">Load Calendar Events</button>
		<div id="calendarEvents" class="mt-4"></div>
	@endauth
	
	<script>
		document.getElementById('loadCalendar').addEventListener('click', function () {
			fetch('{{ route('calendar.events') }}')
				.then(response => response.json())
				.then(data => {
					const calendarContainer = document.getElementById('calendarEvents');
					calendarContainer.innerHTML = ''; // Kosongkan elemen sebelumnya
					
					if (data.events && data.events.length > 0) {
						const ul = document.createElement('ul');
						data.events.forEach(event => {
							const li = document.createElement('li');
							li.textContent = `${event.summary} (${event.start})`;
							ul.appendChild(li);
						});
						calendarContainer.appendChild(ul);
					} else {
						calendarContainer.textContent = 'No events found.';
					}
				})
				.catch(error => {
					console.error('Error fetching calendar events:', error);
					document.getElementById('calendarEvents').textContent = 'Failed to load events.';
				});
		});
		
	</script>	
</x-layout>