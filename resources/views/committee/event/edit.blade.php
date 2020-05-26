@extends('layouts.app')

@section('title', 'Edit ' .$event->name.' |')

@section('content')
    @include('users.partials.header', ['title' => __('Committee')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ Breadcrumbs::render('committee.event.edit', $event->id) }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('committee.event.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('committee.event.update', $event) }}" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('Event information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $event->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('description', $event->description) }}" required>{{ old('description', $event->description) }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-start_date">{{ __('Start date') }}</label>
                                    <input type="datetime-local" name="start_date" id="input-start_date" class="form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Start date') }}" value="{{ date('Y-m-d\TH:i',strtotime($event->start_date)) }}" required>

                                    @if ($errors->has('start_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('end_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-end_date">{{ __('End date') }}</label>
                                    <input type="datetime-local" name="end_date" id="input-end_date" class="form-control form-control-alternative{{ $errors->has('end_date') ? ' is-invalid' : '' }}" placeholder="{{ __('End date') }}" value="{{ date('Y-m-d\TH:i',strtotime($event->end_date)) }}" required>

                                    @if ($errors->has('end_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('venue') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-venue">{{ __('Venue') }}</label>
                                    <input type="text" name="venue" id="input-venue" class="form-control form-control-alternative{{ $errors->has('venue') ? ' is-invalid' : '' }}" placeholder="{{ __('Venue') }}" value="{{ old('venue', $event->venue) }}" required autofocus>

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
                                                <option value="{{$level->id}}" {{ $event->level_id==$level->id ? "selected" : ''}}>{{$level->name}}</option>
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
                                                <option value="{{$domain->id}}" {{ $event->domain_id==$domain->id ? "selected" : ''}}>{{$domain->name}}</option>
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
                                                <option value="{{$category->id}}" {{ $event->category_id==$category->id ? "selected" : ''}}>{{$category->name}}</option>
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
                                                <option value="{{$club->id}}" {{ $event->club_id==$club->id ? "selected" : ''}}>{{$club->name}}</option>
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
                                    <input type="text" name="requirement" id="input-requirement" class="form-control form-control-alternative{{ $errors->has('requirement') ? ' is-invalid' : '' }}" placeholder="{{ __('Open to all/ For club member only') }}" value="{{ old('requirement', $event->requirement) }}" required autofocus>

                                    @if ($errors->has('requirement'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('requirement') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('capacity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-capacity">{{ __('Capacity') }}</label>
                                    <input type="number" name="capacity" id="input-capacity" class="form-control form-control-alternative{{ $errors->has('capacity') ? ' is-invalid' : '' }}" placeholder="{{ __('Capacity') }}" value="{{ old('capacity', $event->capacity) }}" required autofocus>

                                    @if ($errors->has('capacity'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('fees') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-fees">{{ __('Fees') }}</label>
                                    <input type="number" step="0.10" name="fees" id="input-fees" class="form-control form-control-alternative{{ $errors->has('fees') ? ' is-invalid' : '' }}" placeholder="{{ __('Fees') }}" value="{{ old('fees', $event->fees) }}" required autofocus>

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

    <div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div id="contacts">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="mb-3">{{ __('Manage Event Image') }}</h3>
                            </div>
                        </div>
                        <form action="{{ route('event.image.store') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}

                            <div class="row align-items-center">
                                <br><br>
                                <input name="event_id" type="hidden" value="{{ $event->id }}">
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

                            @foreach($images as $image)

                            <tr>

                                <td class="name"><img src="{{asset('img/event/'.$image->filename)}}" alt="..." class="img-thumbnail"></td>



                                <td class="text-center">
                                    <div class="dropdown">
                                        
                                        <form action="{{ route('event.image.destroy', $image->id) }}" method="post">

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