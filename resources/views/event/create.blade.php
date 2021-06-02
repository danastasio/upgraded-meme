<x-app-layout>
	@include('flash-message')
	<div class="mx-auto text-center">
		<div class="mt-5">
			Add the details of your event here!
		</div>
		<div>
			{{ $event_name }}
		</div>
		<div>
			Date and time options:
		</div>
		<form method="post" id="event_details" action="{{ route('event.store') }}">
			@csrf
			<div id="event_options">
				<input type="hidden" name="event_name" value="{{ $event_name }}">
				<div class="mt-5" id="option">
					<input name="date[]" type="date">
					<input name="time[]" type="time">
				</div>
			</div>
			<input type="submit">
		</form>
		<button onclick="addOption()" class='bg-blue-500 p-5 mt-3 rounded'>Add another date and time</button>
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
