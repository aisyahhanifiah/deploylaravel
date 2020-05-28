@extends('layouts.app')

@section('title', 'Members for ' .$clubsname->name.' |')

@section('content')
<div class="header pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="col-md-12"><h1 class="display-2 ">Administrator</h1></div>
        <div class="header-body">{{ Breadcrumbs::render('admin.club.member', $clubsname->id) }}</div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div id="contacts">
                    <div class="card-header table-responsive border-0">

                        <form action="{{ route('admin.club.member.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h3 class="mb-0">{{ __('Add New Member') }}</h3>
                                </div><br><br>
                                <input name="club_id" type="hidden" value="{{ $clubsname->id }}">
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('user') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="select-beast2">{{ __('Name') }}</label>
                                        <select id="select-beast2" class="{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user_id" >
                                            <option value="">Search a person...</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->unikl_id}}&nbsp&nbsp{{$user->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('user'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('position') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="select-beast">{{ __('Position') }}</label>
                                        <select id="select-beast" class="{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position_id" >
                                            <option value="">Position...</option>
                                            @foreach($positions as $position)
                                            <option value="{{$position->id}}">{{$position->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Add member') }}</button>

                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <hr class="my-3">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h3 class="mb-0">{{ __('All Club Members') }}</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control search" placeholder="Search" type="text">
                                </div>     
                            </div>
                            <div class="col-md-2 text-md-right text-left py-2">
                                                           
                                <a href="{{ route('memberforclub.export', $clubsname->id) }}" class="btn btn-sm btn-primary">{{ __('Generate Report') }}</a>
                            </div>
                            <div class="col-md-2 text-md-right text-left py-2">
                                <a href="{{ route('admin.club.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                
                            </div>
                        </div>
                        <div class="row align-items-center">
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('statuswarning'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('statuswarning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
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

                    <div class="table-responsive">
                        <table class="table table-responsive-md align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="no" style="cursor: pointer;width: 10px;">No.<span><i class="fas fa-sort"></i></span></th>
                                    <th style="width: 300px;" class="sort" data-sort="name" style="cursor: pointer;">Name <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="unikl" style="cursor: pointer;">UniKL ID <span><i class="fas fa-sort"></i></span></th>
                                    <th style="width: 250px;" class="sort" data-sort="email" style="cursor: pointer;">Email <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="position_name" style="cursor: pointer;">Position <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="creation" style="cursor: pointer;">Creation Date <span><i class="fas fa-sort"></i></span></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody  class="list">
                                @foreach ($clubs as $user)
                                <tr>
                                    <td class="no">{{ $no=$no+1 }}</td>
                                    <td>
                                        <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img alt="Image placeholder" src="{{ Gravatar::src($user->email) }}">
                                            </span>&nbsp&nbsp&nbsp&nbsp<span class="name text-truncate">{{ $user->user_name }}</span>
                                        </div>
                                    </td>
                                    <td class="unikl">{{ $user->unikl_id }}</td>
                                    <td class="email">{{ $user->email }}</td>

                                    {{-- {{ dd($position) }} --}}
                                    {{-- @foreach ($clubs->positions as $position) --}}
                                    {{-- @if($user->pivot->user_id == $user->pivot->position_id) --}}
                                    <td class="position_name">{{ $user->position_name }}</td>
                                    {{-- @endif --}}
                                    {{-- @endforeach --}}
                                    @foreach($findCreate->where('user_id', $user->id) as $a)
                                    <td class="creation">{{ Carbon\Carbon::parse($a->created_at)->format('d/m/Y h:iA') }}</td>
                                    @endforeach
                                   {{--  <td class="creation">{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}</td> --}}
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.club.member.destroy', $user->id) }}" method="post">

                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}

                                                    <input name="clubid" type="hidden" value="{{ $clubsname->id }}">
                                              
                                                    {{-- {{dd($clubs->id)}} --}}

                                                
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to remove this member?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>    
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{-- {{ $users->links() }} --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@section('loadlist')
<script src="{{ asset('argon') }}/js/sortmember.js"></script>
<script>
    $('#select-beast').selectize({
        sortField: {
            field: 'value',
            direction: 'asc'
        },
        dropdownParent: 'body'
    });
    $('#select-beast2').selectize({
        sortField: {
            field: 'text',
            direction: 'asc'
        },
        dropdownParent: 'body'
    });
</script>
@endsection
@endsection