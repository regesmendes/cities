@extends("layouts.app")

@section("content")
    <div class="container">
    	@if ($land->city) 
    		@if ($land->city->isOwnedByLoggedUser())
        		<div class="col-xs-12 col-md-4">
    				<h2>{{ $land->city->name }}</h2>
    				@foreach($land->production()->groupBy('resource_id') as $ress)
    					{{ $ress[0]->resource->name }}: {{ $ress->sum('base') }}/h<br>
    				@endforeach
    				<a href="/realm/{{ $land->realm_id }}" class="btn btn-primary" role="button">Map</a>
        		</div>
        		<div class="col-xs-12 col-md-8">
        			<div class="col-xs-12">
            			@foreach($land->resources()->get() as $stock)
                			<div class="col-md-3">
                				<h3>{{ $stock->resource->name }}</h3>
                				<p>{{ $stock->quantity }}</p>
                			</div>
                		@endforeach
        			</div>
        			@if ($land->places->count() < 10)
                		<div class="col-xs-12">
        					@foreach($buildingOpts as $buildingOpt)
        						<div class="col-xs-3">
        							<div class="col-xs-8">
                    					<img alt="" src="{{ asset('img/' . str_replace(' ', '_', $buildingOpt->name) . '.png') }}" class="img-responsive img-circle">
                    					<h3>{{ $buildingOpt->name }}</h3>
        							</div>
        							<div class="col-xs-12">
            							@foreach($buildingOptData[$buildingOpt->id]['resources'] as $rss)
            								{{ $rss['name'] }}: {{ $rss['quantity'] }} 
            								<i class="fas {{ $rss['hasEnough'] ? 'fa-check' : 'fa-times-circle' }}"></i>
            								<br>
            							@endforeach

            							@if ($buildingOptData[$buildingOpt->id]['canBuild'])
                                			<form action="/newBuilding" method="post">
                            					<input type="hidden" name="land" value="{{ $land->id }}">
                            					<input type="hidden" name="building" value="{{ $buildingOpt->id }}">
                        						<button class="btn btn-default">Build</button>
                        					</form>
                    					@endif
        							</div>
                				</div>
        					@endforeach
                		</div>
            		@endif
        		</div>
    
    			@foreach($land->places as $bl)
            		<div class="col-xs-2">
            			<div class="panel panel-primary">
            				<div class="panel-heading">
            					<h3><span class="badge badge-primary">{{ $bl->level }}</span> {{ $bl->building->name }}</h3>
            				</div>
                			<div class="panel-body">
                    			<div>
                    				@if ($bl->isUnderConstruction())
                    					<i class="fas fa-gavel"></i>
                    				@else 
                        				@foreach($bl->production()->get() as $prod)
                        					{{ $prod->resource->name }}: {{ $prod->base }}/h
                        				@endforeach
                        			@endif
                    			</div>
            					<img alt="" src="{{ asset('img/' . str_replace(' ', '_', $bl->building->name) . '.png') }}" class="img-responsive"> 
                				@if (!$bl->isUnderConstruction())
                					<div class="text-center">
                            			<form method="post" action="/demolishBuilding">
                        					<input type="hidden" name="building_land" value="{{ $bl->id }}">
                        					<input type="hidden" name="land" value="{{ $bl->land_id }}">
                        					<input type="hidden" name="building" value="{{ $bl->building_id }}">
                        					<button class="btn btn-default">Demolish</button>
                            			</form>
                        			</div>
                    			@endif
                    		</div>
            				@if (!$bl->isUnderConstruction())
                    			<div class="panel-footer">
                        			<div class="panel panel-default">
        								<div class="panel-heading">
        									Next Level
        								</div>
        								<div class="panel-body">
        									{{--
                							@foreach($buildingOptData[$buildingOpt->id]->resources as $rss)
                								{{ $rss['name'] }}: {{ $rss['quantity'] }} 
                								<i class="fas {{ $rss['hasEnough'] ? 'fa-check' : 'fa-times-circle' }}"></i>
                								<br>
                							@endforeach
                							--}}
        								</div>                			
                        			</div>
                        		</div>
                    		@endif
            			</div>
            		</div>
    			@endforeach
    			<div class='col-xs-12'><hr></div>
    		@else
    			<p>This city is not of your business yet.</p>
    			<a href="/realm/{{ $land->realm_id }}" class="btn btn-primary" role="button">Map</a>
    		@endif
    	@else
    		@if (Auth::user()->cities->count() > 0)
    			<p>You can't found another city yet.</p>
    			<a href="/realm/{{ $land->realm_id }}" class="btn btn-primary" role="button">Map</a>
    		@else
            	<form action="/newCity" method="post">
                    <input type="hidden" name="land" value="{{ $land->id }}">
            		<div class="col-xs-12 col-md-4">
                		<div class="form-group form-inline">
                			<label for="edtCity">City Name</label>
                			<input class="form-control" id="edtCity" name="name">
            				<button type="submit" class="btn btn-primary">Submit</button>
                		</div>
                	</div>
            	</form>
            @endif
    	@endif
    </div>
@endsection