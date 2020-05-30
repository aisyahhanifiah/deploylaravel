@extends('layouts.app')
@section('title', 'Support |')

@section('content')


<div class="header pb-3 pt-5 pt-md-8">
	<div class="container-fluid">
		<div class="header-body">
			{{ Breadcrumbs::render('support') }}
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1 class="display-2 ">Support</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 pt-3">
			<p>1) How to download our web application to your phone?</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 pt-3 table-responsive-md">
			<img src="{{asset('img')}}/support.png" alt="..." class="img-thumbnail">
		
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 pt-3">
			<p>For more enquiries, please email to admin@clubhub.com</p>
		</div>
	</div>

@include('layouts.footers.auth')
</div>
@endsection