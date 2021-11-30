<x-app-layout>
	@include('flash-message')

	<div class='text-center mt-10 font-bold text-2xl'>
		{{ $event->name }}
	</div>

	<div class='text-center my-5 font-semibold text-xl'>
		{{ $event->description }}
	</div>


		<div class="grid grid-cols-{{ count($event->details) + 1}} max-w-6xl gap-2 mx-auto">
			<div></div>
			@foreach( $event->details as $details)
				<div class='text-center sticky top-0 bg-gray-100 bg-opacity-100 divide-x-2 divide-dashed divide-green-600 py-3'>
					<div class='font-semibold'>{{ date("l jS M, Y", strtotime($details->date)) }}</div>
					@if(isset($details->time))
						<div>{{ date("g:i a", strtotime($details->time)) }}</div>
					@endif
				</div>
			@endforeach
        </div>
		<!-- already responses go here -->
	    @foreach($event->responses as $response)
	    <div class="grid grid-cols-{{ count($event->details) }}">
				<div class="bg-gray-400 flex">
					<div class='m-auto text-xl'>
						{{ $response->name }}
					</div>
				</div>
			<div>
				@if($response->response === "yes")
					<div class='h-full w-full bg-green-600'><img src="{{ url('/images/yes.png') }}" class='py-3 mx-auto w-10'></div>
				@elseif($response->response === "maybe")
					<div class='h-full w-full bg-yellow-600'><img src="{{ url('/images/maybe.png') }}" class='py-3 mx-auto w-10'></div>
				@else
					<div class='h-full w-full bg-red-600'><img src="{{ url('/images/no.png') }}" class='py-3 mx-auto w-10'></div>
				@endif
			</div>
		</div>
		@endforeach
		<form method="post" action="{{ route('response.store') }}">
		@csrf
		<input type="text" placeholder="Respondant" name="name" class='rounded'>
		@foreach($event->details as $details)
		    <input type="hidden" name="event_ids[]" value="{{ $details->id }}">
		    <input type="hidden" name="event_id" value="{{ $event->id}}">
		    <div>
			    <input type="radio" name="{{ 'radio' . $details->id }}" value="yes">
			    <label for="yes">Yes</label><br>
			    <input type="radio" name="{{ 'radio' . $details->id }}" value="maybe">
			    <label for="yes">Maybe</label><br>
			    <input type="radio" name="{{ 'radio' . $details->id }}" value="no" checked="checked">
			    <label for="yes">No</label>
		    </div>
		@endforeach
		<input type="submit" value="Respond" class="py-1 px-3 rounded border-2 text-green-600 border-green-600 hover:bg-green-600 hover:text-white">

		</div>
	</form>

	<div class="mt-24 text-center pb-10">
		<div class="text-xl font-semibold">Share this link with others! It's the only way they can access this page.</div> <div> <input type='class' class='mt-3 outline border border-2 rounded p-1 w-auto cols-80 w-1/4' id="linkurl" value="{{ route('response.create', ['id'=>$event->id]) }}"></div>
		<button onclick="copyLink()" class="rounded bg-blue-500 p-1 px-6 mt-3">Copy to Clipboard</button>
		<a class='bg-purple-600 p-1 px-6 mt-3 rounded' href="mailto:?subject=Meeting Poll&body=Hello! Please fill out this poll so we can decide on a time for our event! {{ route('response.create', ['id'=>$event->id]) }}">Email this link!</a>
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
