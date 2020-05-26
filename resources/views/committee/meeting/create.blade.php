@extends('layouts.app')

@section('title', 'Add Meeting |')

@section('content')
    @include('users.partials.header', ['title' => __('Committee')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ Breadcrumbs::render('committee.meeting.create') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('committee.meeting.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('committee.meeting.store') }}" autocomplete="off">
                            {{ csrf_field() }}
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('meeting information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                               
                                <div class="form-group{{ $errors->has('datetime') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-datetime">{{ __('Date and time') }}</label>
                                    <input type="datetime-local" name="datetime" id="input-datetime" class="form-control form-control-alternative{{ $errors->has('datetime') ? ' is-invalid' : '' }}" placeholder="{{ __('Start date') }}" value="{{ date('Y-m-d\TH:i',strtotime(Carbon\Carbon::now())) }}" required>

                                    @if ($errors->has('datetime'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('datetime') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              
                                <div class="form-group{{ $errors->has('venue') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-venue">{{ __('Venue') }}</label>
                                    <input type="text" name="venue" id="input-venue" class="form-control form-control-alternative{{ $errors->has('venue') ? ' is-invalid' : '' }}" placeholder="{{ __('Venue') }}" value="{{ old('venue') }}" required autofocus>

                                    @if ($errors->has('venue'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('venue') }}</strong>
                                        </span>
                                    @endif
                                </div>
                               
                                <div class="form-group{{ $errors->has('club') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-category">{{ __('Club') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('club') ? ' is-invalid' : '' }}" name="club_id" id="input-club">
                                          @foreach($clubs as $club)
                                                <option value="{{$club->id}}">{{$club->name}}</option>
                                              @endforeach
                                        </select>
                                
                                    @if ($errors->has('club'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('club') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection