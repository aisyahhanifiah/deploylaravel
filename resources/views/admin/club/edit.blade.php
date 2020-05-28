@extends('layouts.app')

@section('title', 'Edit ' .$club->name.' |')


@section('content')
    @include('users.partials.header', ['title' => __('Administrator')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ Breadcrumbs::render('admin.club.edit', $club->id) }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.club.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.club.update', $club) }}" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('Club information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $club->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('semester') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-semester">{{ __('Semester') }}</label>
                                    <select class="form-control form-control-alternative{{ $errors->has('semester') ? ' is-invalid' : '' }}" name="semester" id="input-semester">
                                          <option value="{{$club->semester}}" {{ $club->semester==$club->semester ? "selected" : ''}}>{{$club->semester}}</option>
                                    </select>
                                    
                                    @if ($errors->has('semester'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('semester') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description', $club->description) }}" required>{{ old('description', $club->description) }}</textarea>

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
                                                <option value="{{$domain->id}}" {{ $club->domain_id==$domain->id ? "selected" : ''}}>{{$domain->name}}</option>
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
                                    <input type="text" name="requirement" id="input-requirement" class="form-control form-control-alternative{{ $errors->has('requirement') ? ' is-invalid' : '' }}" placeholder="{{ __('Requirement') }}" value="{{ old('requirement', $club->requirement) }}" required autofocus>

                                    @if ($errors->has('requirement'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('requirement') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('capacity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-capacity">{{ __('Capacity') }}</label>
                                    <input type="number" name="capacity" id="input-capacity" class="form-control form-control-alternative{{ $errors->has('capacity') ? ' is-invalid' : '' }}" placeholder="{{ __('Capacity') }}" value="{{ old('capacity', $club->capacity) }}" required autofocus>

                                    @if ($errors->has('capacity'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('fees') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-fees">{{ __('Fees') }}</label>
                                    <input type="number" step="0.10" name="fees" id="input-fees" class="form-control form-control-alternative{{ $errors->has('fees') ? ' is-invalid' : '' }}" placeholder="{{ __('Fees') }}" value="{{ old('fees', $club->fees) }}" required autofocus>

                                    @if ($errors->has('fees'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fees') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('url_fb') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url_fb">{{ __('Facebook URL') }}</label>
                                    <input type="text" name="url_fb" id="input-url_fb" class="form-control form-control-alternative{{ $errors->has('url_fb') ? ' is-invalid' : '' }}" placeholder="{{ __('Facebook URL') }}" value="{{ old('url_fb', $club->url_fb) }}" autofocus>

                                    @if ($errors->has('url_fb'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url_fb') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('url_ig') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url_ig">{{ __('Instagram URL') }}</label>
                                    <input type="text" name="url_ig" id="input-url_ig" class="form-control form-control-alternative{{ $errors->has('url_ig') ? ' is-invalid' : '' }}" placeholder="{{ __('Instagram URL') }}" value="{{ old('url_ig', $club->url_ig) }}" autofocus>

                                    @if ($errors->has('url_ig'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url_ig') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('url_email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-url_email">{{ __('Email URL') }}</label>
                                    <input type="text" name="url_email" id="input-url_email" class="form-control form-control-alternative{{ $errors->has('url_email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email URL') }}" value="{{ old('url_email', $club->url_email) }}" autofocus>

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

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div id="contacts">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="mb-3">{{ __('Manage Club Image') }}</h3>
                                </div>
                            </div>
                            <form action="{{ route('club.image.store') }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}

                                <div class="row align-items-center">
                                    <br><br>
                                    <input name="club_id" type="hidden" value="{{ $club->id }}">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-image">{{ __('Profile Image') }}</label>
                                            <input type="file" name="image" id="input-image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="{{ __('Image') }}" value=""  autofocus>

                                            @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                            @endif
                                        </div></div>

                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-sm btn-primary">{{ __('Add Image') }}</button>

                                        </div>

                                    </div>
                                </form>

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


                            <div class="table-responsive" >
                              <table class="table table-responsive-md align-items-center">
                                <thead class="thead-light">
                                  <tr>
                                    <th class="sort" data-sort="name" style="cursor: pointer;">Name <span><i class="fas fa-sort"></i></span></th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if($images == NULL)
                                <p>No images yet.</p>
                                @endif
                                @foreach($images as $image)

                                <tr>

                                    <td class="name"><img src="{{asset('img/club/'.$image->filename)}}" alt="..." class="img-thumbnail"></td>



                                    <td class="text-center">
                                        <div class="dropdown">
                                            
                                            <form action="{{ route('club.image.destroy', $image->id) }}" method="post">

                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                
                                                <button type="button" class="btn btn-sm btn-warning" onclick="confirm('{{ __("Are you sure you want to remove this image?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>                                    </div>
                                        </td>
                                    </tr>
                                    @endforeach                     
                                </tbody>
                            </table>

                        </div>

                    </div>


                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{-- {{ $users->links() }} --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection