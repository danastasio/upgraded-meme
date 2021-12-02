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
				<div class="mt-5" id="option">
					<input name="event_details[0][date]" type="date" class="rounded">
					<input name="event_details[0][time]" type="time" class="rounded">
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-2 mx-auto mt-8 max-w-lg">
				<button type="button" onclick="addOption()" class="py-3 bg-blue-500 rounded text-white text-center">Add another date and time</button>
				<input type="submit" class="py-3 bg-green-500 hover:bg-green-800 text-white rounded text-lg" value="Create Event">
			</div>
	</form>
	</div>
	<div class="hidden">
		<div class="mt-5" id="blank_options" name="blank_options">
			<input id="date" name="" type="date" class="rounded">
			<input id="time" name="" type="time" class="rounded">
		</div>
	</div>
	<script>
		var addons = 1;
		var time_addons = 1;
		function addOption() {
    		let original = document.getElementById("blank_options");
    		let clone = original.cloneNode(true);
    		clone.querySelector("#date").setAttribute("name", "event_details[" + time_addons + "][date]");
    		clone.querySelector("#time").setAttribute("name", "event_details[" + time_addons + "][time]");
    		document.getElementById("time_options").appendChild(clone);
    		time_addons += 1;
		}
	function addPerson() {
		if (addons < 6) {
			var itm = document.getElementById("person_template");
			var cln = itm.cloneNode(true);
			cln.id = "person" + addons;
			document.getElementById("table").appendChild(cln);
			addons += 1;
		} else {
			alert('You have reached the maximum number of additions');
		}
	}

	function delPerson(n) {
		if (addons != 0) {
			var delDiv = document.getElementById(n);
			delDiv.remove();
			addons -= 1;
		} else {
			alert('Cannot remove the last person');
		}
	}
	</script>
</x-app-layout>
