<x-app-layout>
	@include('flash-message')

	<div class="text-center mt-10 font-bold text-2xl">
		{{ $event->name }}
	</div>

	<div class="text-center my-5 font-semibold text-xl">
		{{ $event->description }}
	</div>


		<div class="grid grid-cols-{{ count($event['details']) + 1}} max-w-6xl gap-2 mx-auto divide-x-2 divide-dashed divide-green-600">
			<div></div>
			@foreach( $event['details'] as $details)
				<div class="text-center sticky top-0 bg-gray-100 bg-opacity-100 py-3">
					<div class="font-semibold">{{ date("l jS M, Y", strtotime($details->date)) }}</div>
					@if(isset($details->time))
						<div>{{ date("g:i a", strtotime($details->time)) }}</div>
					@endif
				</div>
			@endforeach
		</div>
		<!-- already responses go here -->

		<div class="grid grid-cols-{{ count($event['details']) + 1 }} max-w-6xl gap-2 mx-auto">
			@php
				$last_uuid = null
			@endphp
			@foreach($event['responses'] as $response)
				@if($last_uuid != $response->uuid)
					@php
						$last_uuid = $response->uuid;
						$new_line = true;
					@endphp
				@endif
				@if($new_line)
					<div class="bg-gray-400 flex">
						<div class="m-auto text-xl">
							{{ $response->name }}
						</div>
					</div>
					@php
						$new_line = false;
					@endphp
				@endif
				<div>
					@if($response->response === "yes")
						<div class="h-full w-full bg-green-100">
							<svg xmlns="http://www.w3.org/2000/svg" style="transform: scale(-1, 1)" class="transform -scale-x-1 m-auto text-green-600 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</div>
					@elseif($response->response === "maybe")
						<div class="h-full w-full bg-yellow-100">
							<svg xmlns="http://www.w3.org/2000/svg" class="m-auto text-yellow-700 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
							</svg>
						</div>
					@else
						<div class="h-full w-full bg-red-100">
							<svg xmlns="http://www.w3.org/2000/svg" class="m-auto text-red-700 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
							</svg>
						</div>
					@endif
				</div>
			@endforeach
		</div>
		<form method="post" action="{{ route('response.store') }}">
			<div class="grid grid-cols-{{ count($event['details']) + 1 }} max-w-6xl gap-2 mx-auto mt-4">
				@csrf
				<div>
					<input type="text" placeholder="Your Name" name="name" class="w-full h-full rounded" required>
				</div>
				@foreach($event['details'] as $details)
					<input type="hidden" name="user_response[{{$details->id}}][event_details_id]" value="{{ $details->id }}">
					<input type="hidden" name="event_uuid" value="{{ $event->uuid }}">
					<div>
						<input type="radio" name="user_response[{{ $details->id }}][response]" value="yes">
						<label for="yes">Yes</label><br>
						<input type="radio" name="user_response[{{ $details->id }}][response]" value="maybe">
						<label for="yes">Maybe</label><br>
						<input type="radio" name="user_response[{{ $details->id }}][response]" value="no" checked="checked">
						<label for="yes">No</label>
					</div>
				@endforeach
				<div>
					<input type="submit" value="Respond" class="py-1 px-3 rounded border-2 text-green-600 border-green-600 hover:bg-green-600 hover:text-white w-full">
				</div>
			</form>
		</div>

	<div class="mt-24 text-center pb-10">
		<div class="text-xl font-semibold">Share this link with others! It's the only way they can access this page.</div> <div> <input type='class' class="mt-3 outline border border-2 rounded p-1 w-auto cols-80 w-1/4" id="linkurl" value="{{ route('response.create', ['uuid'=>$event->uuid]) }}"></div>
		<button onclick="copyLink()" class="rounded bg-blue-500 p-1 px-6 mt-3">Copy to Clipboard</button>
		<a class="bg-purple-600 p-1 px-6 mt-3 rounded' href="mailto:?subject=Meeting Poll&body=Hello! Please fill out this poll so we can decide on a time for our event! {{ route('response.create', ['id'=>$event->id]) }}">Email this link!</a>
	</div>
	<script>
		function copyLink() {
  			var copyText = document.getElementById("linkurl");
  			copyText.select();
  			copyText.setSelectionRange(0, 99999); /* For mobile devices */
  			document.execCommand("copy");
		}
	</script>
</x-app-layout>
