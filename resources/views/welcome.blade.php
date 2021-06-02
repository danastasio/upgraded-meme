<x-app-layout>
	<div class='mx-auto text-center mt-4 max-w-7xl'>
		Welcome to doodle 2.0
		<div class="mt-3">
			Enter the name of your event to get started
		</div>
		<div class="mt-3 w-full">
			<form method="get" action="{{ route('event.create') }}">
				<label for="event_name" class='w-full text-left'>Event Name</label>
				<input type="text" name="event_name" id="event_name" class='w-full rounded outline outline-blue mt-3'>
				<button type='submit' class='bg-blue-400 p-5 rounded-md hover:bg-blue-700 mt-3 w-full'>Submit</button>
			</form>
	</div>
</x-app-layout>
