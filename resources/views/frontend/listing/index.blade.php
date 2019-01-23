@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))


@push('after-scripts')
	<script>
	    function filterCars(query)
	    {
	        window.location.href = "{{ route('frontend.cars-for-sale') }}" + query;
	    }
	</script>
@endpush

@section('content')

<div class="row mb-4">
    <div class="col-12 col-sm-3 car-filter">
    	<div class="card">
    		<div class="card-header">
    				FIlter 
    		</div>
    		<div class="card-body">	
    			<div class="row">
    				<div class="col-sm-12">
    					<div class="form-group mt-0 mt-sm-3">
		    				<label for="" class="form-control-label d-none d-sm-inline">Category</label>
					       	<select class="form-control" onchange="filterCars(this.value)">
					       		<option selected="" value="?all">All Category</option>
					       		@foreach($categories as $category)
					       			@if($category->name == \Request::get('cat'))
					       				<option selected="selected" value="?cat={{ $category->name }}">{{ $category->name }}</option>
					       			@else
							              <option value="?cat={{ $category->name }}">{{ $category->name }}</option>
							        @endif
					       		@endforeach
					       	</select>
					    </div>
    				</div>	
    				<div class="col-sm-12">
					    <div class="form-group mt-0 mt-sm-3">
					    	<label for="" class="form-control-label d-none d-sm-inline">Make</label>
					       	<select class="form-control clearfix" onchange="filterCars(this.value)">
					       		<option value="?all">All Car Make</option>
					       		@foreach($makes as $make)
					       			@if($make->name == \Request::get('make'))
					       				<option selected="selected" value="?make={{ $make->name }}">{{ $make->name }}</option>
					       			@else
							              <option value="?make={{ $make->name }}">{{ $make->name }}</option>
							        @endif
					       		@endforeach
					       	</select>
					    </div>				
    				</div>	
    			</div>

    		</div>
    	</div>
    </div>
    <div class="col-12 col-sm-9">
        <div class="card">
        	<div class="card-header bg-transparent">
        		 <h4>Cars for Sale 
        		 	@auth<a href="{{ route('frontend.user.account.listing.create') }}" class="btn btn-primary btn-sm float-right" title="">New Suggestion</a>@endauth
        		 </h4>
        	</div>
            <div class="card-body">
                 @forelse($listings as $listing)
                    <div class="row clearfix listing-row border-bottom border-primary p-0 mb-2 pb-2">
			           <div class="col-12 col-sm-3 w-100 p-0 p-sm-2">
			           		<img class="img-fluid" src="{{ $listing->featured_image }}" alt="{{ $listing->title }}">
			           </div>
			           <div class="col-12 col-sm-9 p-0 p-sm-2">
			               <h5><a href="{{ $listing->slug }}">{{ $listing->title }}</a></h5>
			               
			               <div class="row">
			                  	<div class="col-7 col-sm-6">
			                  		@if($listing->make)
                                    <span>{{ $listing->make->name }}</span><br>
                                    @endif
                                    @if($listing->model)
                                    <span>{{ $listing->model->name }}</span> @if($listing->model)<br>@endif
                                    @endif
                                   
                                </div>
			                  	<div class="col-5 col-sm-6 text-right align-content-end">
                                    <span class="price float-right text-right">{{ $listing->is_offer ? 'Offer' : '$'.number_format($listing->price,2) }}</span>
                                </div>

			                </div>
			                <p class="mt-2 location text-muted">Location: {{ $listing->location }} <span class="time float-right">{{ $listing->created_at->format('M d') }}</span></p>
					     </div>
                    </div>
                    @empty
                    <div>
                    	No data
                    </div>

                    @endforelse
            </div>
        </div>
    </div>
</div>
    
@endsection
