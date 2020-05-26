@extends('layouts.app')

@section('title', 'Add Club |')


@section('content')
    @include('users.partials.header', ['title' => __('Committee')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Club Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.club.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.club.store') }}" autocomplete="off">
                            {{ csrf_field() }}
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Club information') }}</h6>
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
                                <div class="form-group{{ $errors->has('semester') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-semester">{{ __('Semester') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('semester') ? ' is-invalid' : '' }}" name="semester" id="input-semester">
                                          <option value="July 2019">July 2019</option>
                                    </select>
                                    
                                    @if ($errors->has('semester'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('semester') }}</strong>
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
                                <div class="form-group{{ $errors->has('requirement') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-requirement">{{ __('Requirement') }}</label>
                                    <input type="text" name="requirement" id="input-requirement" class="form-control form-control-alternative{{ $errors->has('requirement') ? ' is-invalid' : '' }}" placeholder="{{ __('Requirement') }}" value="{{ old('requirement') }}" required autofocus>

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
                                <div class="form-group{{ $errors->has('url_fb') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url_fb">{{ __('Facebook URL') }}</label>
                                    <input type="text" name="url_fb" id="input-url_fb" class="form-control form-control-alternative{{ $errors->has('url_fb') ? ' is-invalid' : '' }}" placeholder="{{ __('Facebook URL') }}" value="{{ old('url_fb') }}" autofocus>

                                    @if ($errors->has('url_fb'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url_fb') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('url_ig') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url_ig">{{ __('Instagram URL') }}</label>
                                    <input type="text" name="url_ig" id="input-url_ig" class="form-control form-control-alternative{{ $errors->has('url_ig') ? ' is-invalid' : '' }}" placeholder="{{ __('Instagram URL') }}" value="{{ old('url_ig') }}" autofocus>

                                    @if ($errors->has('url_ig'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url_ig') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('url_email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url_email">{{ __('Email URL') }}</label>
                                    <input type="text" name="url_email" id="input-url_email" class="form-control form-control-alternative{{ $errors->has('url_email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email URL') }}" value="{{ old('url_email') }}" autofocus>

                                    @if ($errors->has('url_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url_email') }}</strong>
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