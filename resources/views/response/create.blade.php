<x-app-layout>
	@include('flash-message')

	<div class='text-center my-10 font-bold text-2xl'>
		{{ @$event_responses[0]['name'] }}
	</div>

	<form method="post" action="{{ route('response.store') }}">
		@csrf
		<div class="grid grid-cols-{{ count($event_details) + 1}} max-w-6xl gap-2 mx-auto">
			<div></div>
			@foreach( $event_details as $details)
				<div class='text-center sticky top-0 bg-gray-100 bg-opacity-100 divide-x-2 divide-dashed divide-green-600 py-3'>
					<div class='font-semibold'>{{ date("l jS M, Y", strtotime($details->date)) }}</div>
					@if(isset($details->time))
						<div>{{ date("g:i a", strtotime($details->time)) }}</div>
					@endif
				</div>
			@endforeach

		<!-- already responses go here -->
		<?php $previous_uuid = null; ?>
		@for($i=0;$i<count($event_responses[0]['responses']);$i++)
			@if($event_responses[0]['responses'][$i]->uuid != $previous_uuid)
				<div class="bg-blue-200 flex">
					<div class='m-auto text-xl'>
						{{ $event_responses[0]['responses'][$i]->name }}
					</div>
				</div>
			@endif
			<div>
				@if($event_responses[0]['responses'][$i]->response === "yes")
					<div class='h-full w-full bg-green-600'><img src="{{ url('/images/yes.png') }}" class='py-3 mx-auto w-10'></div>
				@elseif($event_responses[0]['responses'][$i]->response === "maybe")
					<div class='h-full w-full bg-yellow-600'><img src="{{ url('/images/maybe.png') }}" class='py-3 mx-auto w-10'></div>
				@else
					<div class='h-full w-full bg-red-600'><img src="{{ url('/images/no.png') }}" class='py-3 mx-auto w-10'></div>
				@endif
			</div>
			<?php $previous_uuid = $event_responses[0]['responses'][$i]->uuid; ?>
		@endfor
		<input type="text" placeholder="Respondant" name="name" class='rounded'>
		<?php $i = 0;?>
		@foreach($event_details as $details)
		<input type="hidden" name="event_ids[]" value="{{ $details->id }}">
		<input type="hidden" name="event_id" value="{{ $event_details[0]->event_id }}">
		<!-- <input type="checkbox" name="event_response[]" class="m-auto" style="transform: scaleX(-1);"> -->
		<div>
			<input type="radio" name="{{ 'radio' . $i }}" value="yes">
			<label for="yes">Yes</label><br>
			<input type="radio" name="{{ 'radio' . $i }}" value="maybe">
			<label for="yes">Maybe</label><br>
			<input type="radio" name="{{ 'radio' . $i }}" value="no" checked="checked">
			<label for="yes">No</label>
		</div>
		<?php $i++ ?>
		@endforeach
		<input type="submit" value="Respond" class="py-1 px-3 rounded border-2 text-green-600 border-green-600 hover:bg-green-600 hover:text-white">

		</div>
	</form>

	<div class="mt-24 text-center pb-10">
		<div class="text-xl font-semibold">Share this link with others! It's the only way they can access this page.</div> <div> <input type='class' class='mt-5 outline border border-2 rounded p-1 w-auto cols-80 w-1/4' id="linkurl" value="{{ route('response.create', ['id'=>$event_details[0]->event_id]) }}"></div>
		<button onclick="copyLink()" class="rounded bg-blue-500 p-1 px-6 mt-3">Copy to Clipboard</button>
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
