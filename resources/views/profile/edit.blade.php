@extends('layouts.app')
@section('title', 'Profile |')

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see your co-curricular activities\' summary throughout your study period and manage your profile'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @if(is_null(auth()->user()->image))
                                    <img src="{{ Gravatar::src(auth()->user()->email) }}" class="rounded-circle">
                                    @else
                                    <img src="{{ asset('img/user/'.auth()->user()->image) }}" class="rounded-circle">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">{{ $clubs->count() }}</span>
                                        <span class="description">{{ __('Clubs') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $events->count() }}</span>
                                        <span class="description">{{ __('Activities') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ $clubs->where('position_id', '<', '6')->count() }}</span>
                                        <span class="description">{{ __('Positions') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light">, {{ Carbon\Carbon::parse(auth()->user()->dob)->age }}</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ auth()->user()->unikl_id }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ auth()->user()->email }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ __('Universiti Kuala Lumpur MIIT') }}
                            </div>
                            {{-- <hr class="my-4" /> --}}
                            {{-- <p>{{ __('Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.') }}</p> --}}
                            {{-- <a href="#">{{ __('Show more') }}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            @if(($queryName == null) || ($queryPhone == null) || ($queryGender == null) || ($queryDOB == null))
                            <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Please complete your profile.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            </div>
                            @endif
                            @if($queryCard == null)
                            <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Please add your bank card to make payment.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            </div>
                            @endif

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image">{{ __('Profile Image') }}</label>
                                    <input type="file" name="image" id="input-image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value=""  autofocus>

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone_no') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone_no">{{ __('Phone No.') }}</label>
                                    <input type="text" name="phone_no" id="input-phone_no" class="form-control form-control-alternative{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone No.') }}" value="{{ old('phone_no', auth()->user()->phone_no) }}" required autofocus>

                                    @if ($errors->has('phone_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('unikl_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-unikl_id">{{ __('UniKL ID') }}</label>
                                    <input type="number" name="unikl_id" id="input-unikl_id" class="form-control form-control-alternative{{ $errors->has('unikl_id') ? ' is-invalid' : '' }}" placeholder="{{ __('UniKL ID') }}" value="{{ old('unikl_id', auth()->user()->unikl_id) }}" required autofocus>

                                    @if ($errors->has('unikl_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('unikl_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-gender">{{ __('Gender') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" id="input-gender">
                                            <option value="Female" {{ auth()->user()->gender=="Female" ? "selected" : ''}}>Female</option>
                                            <option value="Male" {{ auth()->user()->gender=="Male" ? "selected" : ''}}>Male</option>
                                        </select>
                                
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('dob') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-dob">{{ __('Date of Birth') }}</label>
                                    <input type="date" name="dob" id="input-dob" class="form-control form-control-alternative{{ $errors->has('dob') ? ' is-invalid' : '' }}" placeholder="{{ __('Date of Birth') }}" value="@if(auth()->user()->dob != null){{ date('Y-m-d',strtotime(auth()->user()->dob)) }}@endif" required autofocus>

                                    @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('save.customer') }}" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            @if(!is_null($queryCard))
                            <div class="col-12">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        You have registered your bank card {{auth()->user()->stripe_type}} ending {{ auth()->user()->stripe_card }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                            </div>
                            @endif

                            <h6 class="heading-small text-muted mb-4">{{ __('Save your credit/debit card') }}</h6>

                            {{-- @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif --}}

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Full name (on the card)') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Jason Doe') }}" value="" required>
                                    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('cc_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-cc_number">{{ __('Card number') }}</label>
                                    <input type="text" name="cc_number" id="input-cc_number" class="form-control form-control-alternative{{ $errors->has('cc_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Your card number') }}" value="" required>
                                    
                                    @if ($errors->has('cc_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cc_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-exp">{{ __('Expiration') }}</label>
                                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;"  placeholder="MM" name="month" class="form-control form-control-alternative" required>
                                         <br>       
                                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" placeholder="YYYY" name="year" class="form-control form-control-alternative" required>

                                    

                                    @if ($errors->has('month','year'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('month','year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">

                                    <label class="form-control-label" for="input-cvv">{{ __('Three-digits code on the back of your card') }}</label>
                                    <input type="text" name="cvv" placeholder="CVV" required class="form-control form-control-alternative">

                                    @if ($errors->has('cvv'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cvv') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save payment') }}</button>
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