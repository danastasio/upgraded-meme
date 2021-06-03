<?php
/*
        Copyright (C) 2020  David D. Anastasio

        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU Affero General Public License as published
        by the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU Affero General Public License for more details.

        You should have received a copy of the GNU Affero General Public License
        along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
?>
@if (Session::has('success'))
	<div class="mt-2 bg-green-300 py-2 w-1/2 rounded-lg mx-auto text-center">
    	<strong>{{ __(Session::get('success') ) }}</strong>
	</div>
@endif

@if (Session::has('error') || $errors->any())
	@if ( $errors->any() )
		<div class="mt-2 bg-red-300 py-2 w-1/2 rounded-lg mx-auto text-center">
			<ul>
				@foreach ($errors->all() as $error)
					<li><strong>{{ __($error) }}</strong></li>
				@endforeach
			</ul>
		</div>
	@else
		<div class="mt-2 bg-red-300 py-2 w-1/2 rounded-lg mx-auto text-center">
        	<strong>{{ __(Session::get('error') ) }}</strong>
		</div>
	@endif
@endif

@if (Session::has('warning'))
	<div class="mt-2 bg-yellow-300 py-2 w-1/2 rounded-lg mx-auto text-center">
		<strong>{{ __(Session::get('warning')) }}</strong>
	</div>
@endif

@if (Session::has('info'))
	<div class="mt-2 bg-gray-300 py-2 w-1/2 rounded-lg mx-auto text-center">
		<strong>{{ __(Session::get('info')) }}</strong>
	</div>
@endif
