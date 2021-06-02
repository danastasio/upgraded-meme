<x-app-layout>
	@include('flash-message')
	<div class="mx-auto text-center">
		<div class="mt-8 font-bold text-2xl">
			Add the details of your event here!
		</div>
		<div class="mt-8 font-semibold text-lg">
			{{ $event_name }}
		</div>
		<div class="mt-8">
			Date and time options: (time is optional)
		</div>
		<form method="post" id="event_details" action="{{ route('event.store') }}">
			@csrf
			<div id="event_options">
				Event Name: <input type="text" name="event_name" value="{{ $event_name }}">
				<div class="mt-5" id="option">
					<input name="date[]" type="date">
					<input name="time[]" type="time">
				</div>
			</div>
			<div class="grid grid-cols-2 gap-2 max-w-lg mx-auto mt-8">
				<div onclick="addOption()" class='py-3 bg-blue-500 rounded'>Add another date and time</div>
				<input type="submit" class="py-3 bg-green-500 text-white rounded text-lg" value="Create Event">
			</div>
	</form>
	</div>
	<div class='hidden'>
		<div class="mt-5" id="blank_options" name="blank_options">
			<input name="date[]" type="date">
			<input name="time[]" type="time">
		</div>
	</div>
	<script>
		function addOption() {
    		var original = document.getElementById("blank_options");
    		var clone = original.cloneNode(true);
    		document.getElementById("event_options").appendChild(clone);
		}
	</script>
</x-app-layout>
