<x-app-layout>
	@include("flash-message")
	<div class="mx-auto text-center mt-4 max-w-7xl mt-20">
		<div class="font-bold text-4xl">Welcome to Foodle Poll</div>
		<div class="mt-8 font-semibold text-xl">Enter the name of your event to get started</div>
	</div>
	<form method="get" action="{{ route('event.create') }}">
	    <div class="flex-none max-w-md mx-auto mt-4 px-2">
			    <label for="event_name" class="w-full text-left">Event Name:</label>
			    <input type="text" name="event_name" id="event_name" class="w-full rounded outline outline-blue mt-3" required>
			    <button type="submit" class="rounded-md mt-3 py-3 border-2 border-blue-500 text-blue-500 font-semibold hover:bg-blue-500 hover:text-white w-full">Get Started</button>
		</form>
	</div>
</x-app-layout>
