<x-app-layout>
	@include('flash-message')

	<div class='text-center mb-10 font-bold text-2xl'>
		{{ @$event_responses[0]['name'] }}
	</div>

	<form method="post" action="{{ route('response.store') }}">
		@csrf
		<div class="grid grid-cols-{{ count($event_details) + 1}} max-w-5xl gap-2 mx-auto">
		<div></div>
		@foreach( $event_details as $details)
			<div class='text-center'>
				<div>{{ $details->date }}</div>
				<div>{{ $details->time }}</div>
			</div>
		@endforeach

		<!-- already responses go here -->
		<?php $previous_uuid = null; ?>
		@for($i=0;$i<count($event_responses[0]['responses']);$i++)
			@if($event_responses[0]['responses'][$i]->uuid != $previous_uuid)
				<div>
					{{ $event_responses[0]['responses'][$i]->name }}
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
		<input type="text" placeholder="your name" name="name">
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
		<input type="submit">

		</div>
	</form>

		<div class="outline mt-5">
			Share this link with others! <input type='class' class='outline border border-2 rounded p-1 w-auto' id="linkurl" value="{{ route('response.create', ['id'=>$event_details[0]->event_id]) }}">
			<button onclick="copyLink()" class="rounded bg-blue-500 p-1">Copy</button>
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
