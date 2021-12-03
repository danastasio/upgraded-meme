<x-app-layout>
	@include('flash-message')
	<div class="flex-none mx-auto text-center px-2 pb-2">
		<div class="mt-8 font-bold text-2xl">
			Add the details of your event here!
		</div>
		<form method="post" id="event_details" action="{{ route('event.store') }}">
			@csrf
			<div id="event_options" class="mx-auto mt-8">
				<div>
					<label for="event_name">Event Name:</label>
				</div>
				<div class="w-full">
					<input type="text" name="name" value="{{ $event_name }}" class="rounded text-center" required>
				</div>
				<div class="mt-5">
					<label for="description">Event summary</label>
				</div>
				<div class="w-full">
					<textarea class="rounded" name="description"></textarea>
				</div>
			</div>
			<div id="time_options">
				<div class="mt-8">
					Date and time options: (time is optional)
				</div>
				<div class="flex w-full justify-center mt-5" id="option">
					<input name="event_details[0][date]" type="date" class="rounded">
					<input name="event_details[0][time]" type="time" class="ml-2 rounded">
					<div></div>
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-2 mx-auto mt-8 max-w-lg">
				<button type="button" onclick="addOption()" class="py-3 bg-blue-500 rounded text-white text-center">Add another date and time</button>
				<input type="submit" class="py-3 bg-green-500 hover:bg-green-800 text-white rounded text-lg" value="Create Event">
			</div>
	</form>
	</div>
	<div class="hidden">
		<div class="flex mx-auto mt-5 ml-4 w-full justify-center" id="blank_options" name="blank_options">
			<input id="date" name="" type="date" class="rounded">
			<input id="time" name="" type="time" class="rounded ml-2">
			<button class="my-auto" id="delete_button" onclick="" title="Remove this option">
			    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 my-auto ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
		</div>
	</div>
	<script>
		var addons = 1;
		var time_addons = 1;
		function addOption() {
		    if (time_addons < 11) {
    		    let original = document.getElementById("blank_options");
    		    let clone = original.cloneNode(true);
    		    clone.querySelector("#date").setAttribute("name", "event_details[" + time_addons + "][date]");
    		    clone.querySelector("#time").setAttribute("name", "event_details[" + time_addons + "][time]");
    		    clone.querySelector("#delete_button").setAttribute("onclick", "delOption('datetime" + time_addons + "')" );
    		    clone.setAttribute('id', 'datetime' + time_addons);
    		    document.getElementById("time_options").appendChild(clone);
    		    time_addons += 1;
    		} else {
    		    alert("Cannot add more than 11 options at this time");
    		}
		}

		function delOption(div_to_remove) {
		    let div = document.getElementById(div_to_remove);
		    div.remove();
		    time_addons -= 1;
		}
	</script>
</x-app-layout>
