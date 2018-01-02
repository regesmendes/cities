@extends("layouts.app")

@section("content")
    <div class="container">
    	<h3>Realm</h3>
    	
    	<table border="1">
    		@for ($x = 0; $x < 50; $x++)
				<tr>
    			@foreach($realm->line($x)->get() as $land)
    				<td>
    					<a href="/land/{{ $land->id }}">
    						&nbsp;{{ "$land->x,$land->y" }}&nbsp;
    					</a>
    				</td>
    			@endforeach
    			</tr>
    		@endfor
    	</table>
    </div>
@endsection