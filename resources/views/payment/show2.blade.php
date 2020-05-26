@extends('layouts.app', ['title' => __('My Past Participations')])

@section('content')
<div class="header pb-8 pt-5 pt-md-8">
	<div class="container-fluid">
        <div class="col-md-12">
            <h1 class="display-2 ">Payment Receipt</h1>
        </div>
		<div class="header-body">
			{{ Breadcrumbs::render('payment.show2', $event->id) }}
		</div>
	</div>
</div>



<div class="container-fluid mt--7">


	<div class="row">
		<div class="col-md-6">
			<div class="card shadow">
				<div id="contacts">
					<div class="card-header border-0">
						<div class="row align-items-center">
							<div class="col-6 col-sm-9">
								<span class="text-uppercase" style="font-size: 0.75rem;">Receipt for </span>
								<h3 class="mb-0 text-uppercase">{{ Auth::user()->name }}</h3>
							</div>
							<div class="col-6 col-sm-3 text-right text-sm-left">
								<h3 class="mb-0">RM{{ number_format($userevent->paid_out, 2)}}</h3>
							</div>
                            {{-- <div class="col-1 text-right">
                                <a href="{{ route('admin.event.create') }}" class="btn btn-sm btn-primary">{{ __('Add event') }}</a>
                            </div> --}}
                        </div>
                    </div>
                    
                    <div class="col-12">
                    	@if (session('status'))
                    	<div class="alert alert-success alert-dismissible fade show" role="alert">
                    		{{ session('status') }}
                    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    			<span aria-hidden="true">&times;</span>
                    		</button>
                    	</div>
                    	@endif
                    </div>
                    <hr class="my-3">
                    <div class="card-body px-lg-6">
                    	<div class="row pb-5">
                    		<div class="col-7 px-5">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Date</span>
                    			<p class="text-md font-weight-bold text-uppercase">{{ Carbon\Carbon::parse($userevent->updated_at)->format('d M Y') }}</p>
                    		</div>
                    		<div class="col-5 px-4">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Time</span>
                    			<p class="text-md font-weight-bold text-uppercase">{{ Carbon\Carbon::parse($userevent->updated_at)->format('h:i A') }}</p>

                    		</div>
                    	</div>
                    	<div class="row ">
                    		<div class="col-7 px-5">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Transaction ID</span>
                    			<p class="text-md font-weight-bold text-uppercase">#{{$userevent->stripe_charge_id}}</p>

                    		</div>
                    		<div class="col-5 px-4">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Payment Method</span>
                    			<p class="text-md font-weight-bold text-uppercase">VISA xxxx-xxxx-xxxx-3920</p>

                    		</div>
                    	</div>
                    </div>
                    <hr class="my-3">
                    <div class="card-body px-lg-10">
                    	<div class="row pb-4">
                    		<div class="col-md-6">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Summary</span>
                    		</div>

                    	</div>

                    	<div class="row py-3 mx-1 bg-primary text-white align-items-center rounded align-items-center">
                    		<div class="col-md-8 px-5">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Fees for joining</span>
                    			<p class="text-md pb-0 font-weight-bold text-uppercase">{{ $event->name }}</p>
                    		</div>
                    		<div class="col-md-4 px-5">
                    			{{-- <span class="text-uppercase" style="font-size: 0.75rem;">Transaction ID</span> --}}
                    			<p class="text-md font-weight-bold text-uppercase text-right">RM{{ number_format($event->fees, 2) }}</p>

                    		</div>
                    	</div>
                    	<div class="row py-3">

                    		<div class="col-11 px-2 text-right">
                    			<span class="text-uppercase" style="font-size: 0.75rem;">Total </span><span class="text-lg font-weight-bold text-uppercase">RM{{ number_format($userevent->paid_out, 2)}}</span>
                    			

                    		</div>
                    	</div>

                    </div>
                    <hr class="my-3">
                    <div class="card-body px-lg-5 pt-0 pb-3 ">
                    	<div class="row">

                    		<div class="col-12 px-2">
                    			<div class="text-center">
                    				<a href="{{ route('print.receipt.event', $userevent->id) }}" class="btn btn-success">{{ __('Print Receipt') }}</a>
                                    {{-- <button type="submit" class="btn btn-success">{{ __('Print Receipt') }}</button> --}}
                    			</div>

                    		</div>
                    	</div>
                    </div>
                    
                    <div class="card-footer py-4">
                    	<nav class="d-flex justify-content-end" aria-label="...">
                    	</nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@section('loadlist')
<script src="{{ asset('argon') }}/js/sortevent.js"></script>
@endsection

@endsection