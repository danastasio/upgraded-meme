<x-app-layout>
	@include('flash-message')
	<div class="mx-auto text-center">
		<div class="mt-8 font-bold text-2xl">
			Add the details of your event here!
		</div>
		<form method="post" id="event_details" action="{{ route('event.store') }}">
			@csrf
			<div id="event_options" class="w-1/2 mx-auto mt-8">
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
					<input name="date[]" type="date" class="rounded">
					<input name="time[]" type="time" class="rounded">
				</div>
			</div>
			<div class="grid grid-cols-2 gap-2 max-w-lg mx-auto mt-8">
				<button type="button" onclick="addOption()" class="py-3 bg-blue-500 rounded text-white text-center">Add another date and time</button>
				<input type="submit" class="py-3 bg-green-500 hover:bg-green-800 text-white rounded text-lg" value="Create Event">
			</div>
	</form>
	</div>
	<div class="hidden">
		<div class="mt-5" id="blank_options" name="blank_options">
			<input name="date[]" type="date" class="rounded">
			<input name="time[]" type="time" class="rounded">
		</div>
	</div>
	<script>
		addons = 1;
		function addOption() {
    		var original = document.getElementById("blank_options");
    		var clone = original.cloneNode(true);
    		document.getElementById("time_options").appendChild(clone);
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
