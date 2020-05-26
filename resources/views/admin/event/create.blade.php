@extends('layouts.app')


@section('title', 'Add Event |')


@section('content')
    @include('users.partials.header', ['title' => __('Administrator')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ Breadcrumbs::render('admin.event.create') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.event.store') }}" autocomplete="off">
                            {{ csrf_field() }}
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Event information') }}</h6>
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
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required></textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-start_date">{{ __('Start date') }}</label>
                                    <input type="datetime-local" name="start_date" id="input-start_date" class="form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Start date') }}" value="{{ date('Y-m-d\TH:i',strtotime(Carbon\Carbon::now())) }}" required>

                                    @if ($errors->has('start_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('end_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-end_date">{{ __('End date') }}</label>
                                    <input type="datetime-local" name="end_date" id="input-end_date" class="form-control form-control-alternative{{ $errors->has('end_date') ? ' is-invalid' : '' }}" placeholder="{{ __('End date') }}" value="{{ date('Y-m-d\TH:i',strtotime(Carbon\Carbon::now())) }}" required>

                                    @if ($errors->has('end_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
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
                                <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-level">{{ __('Level') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level_id" id="input-level">
                                          @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                              @endforeach
                                        </select>
                                
                                    @if ($errors->has('domain'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('domain') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('domain') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-domain">{{ __('Domain') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('domain') ? ' is-invalid' : '' }}" name="domain_id" id="input-domain">
                                          @foreach($domains as $domain)
                                                <option value="{{$domain->id}}">{{$domain->name}}</option>
                                              @endforeach
                                        </select>
                                
                                    @if ($errors->has('domain'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('domain') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-category">{{ __('Category') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category_id" id="input-category">
                                          @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                              @endforeach
                                        </select>
                                
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
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
                                <div class="form-group{{ $errors->has('requirement') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-requirement">{{ __('Requirement') }}</label>
                                    <input type="text" name="requirement" id="input-requirement" class="form-control form-control-alternative{{ $errors->has('requirement') ? ' is-invalid' : '' }}" placeholder="{{ __('Open to all/ For club member only') }}" value="{{ old('requirement') }}" required autofocus>

                                    @if ($errors->has('requirement'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('requirement') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('capacity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-capacity">{{ __('Capacity') }}</label>
                                    <input type="number" name="capacity" id="input-capacity" class="form-control form-control-alternative{{ $errors->has('capacity') ? ' is-invalid' : '' }}" placeholder="{{ __('Capacity') }}" value="{{ old('capacity') }}" required autofocus>

                                    @if ($errors->has('capacity'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('fees') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-fees">{{ __('Fees') }}</label>
                                    <input type="number" step="0.10" name="fees" id="input-fees" class="form-control form-control-alternative{{ $errors->has('fees') ? ' is-invalid' : '' }}" placeholder="{{ __('Fees') }}" value="{{ old('fees') }}" required autofocus>

                                    @if ($errors->has('fees'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fees') }}</strong>
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