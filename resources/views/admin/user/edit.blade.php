@extends('layouts.app')

@section('title', 'Edit ' .$user->name.' |')


@section('content')
    @include('users.partials.header', ['title' => __('Administrator')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ Breadcrumbs::render('admin.user.edit', $user->id) }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('unikl_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-unikl_id">{{ __('UniKL ID') }}</label>
                                    <input type="text" name="unikl_id" id="input-unikl_id" class="form-control form-control-alternative{{ $errors->has('unikl_id') ? ' is-invalid' : '' }}" placeholder="{{ __('UniKL ID') }}" value="{{ old('unikl_id', $user->unikl_id) }}" required>

                                    @if ($errors->has('unikl_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('unikl_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone_no') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone_no">{{ __('Phone No.') }}</label>
                                    <input type="text" name="phone_no" id="input-phone_no" class="form-control form-control-alternative{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone No.') }}" value="{{ old('phone_no', $user->phone_no) }}" required>

                                    @if ($errors->has('phone_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-gender">{{ __('Gender') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" id="input-gender">
                                          <option value="Female" {{ $user->gender=="Female" ? "selected" : ''}}>Female</option>
                                          <option value="Male" {{ $user->gender=="Male" ? "selected" : ''}}>Male</option>
                                        </select>
                                    {{-- <input type="text" name="gender" id="input-gender" class="form-control form-control-alternative{{ $errors->has('gender') ? ' is-invalid' : '' }}" placeholder="{{ __('Gender') }}" value="{{ old('gender', $user->gender) }}" required> --}}

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('dob') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-dob">{{ __('Date of birth') }}</label>
                                    {{-- {{ Form::date('dob', $user->dob, array('class' => 'form-control', 'input-md')) }} --}}
                                    <input type="date" name="dob" id="input-dob" class="form-control form-control-alternative{{ $errors->has('dob') ? ' is-invalid' : '' }}" placeholder="{{ __('Date of birth') }}" value="{{date('Y-m-d',strtotime($user->dob))}}" required>

                                    @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
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