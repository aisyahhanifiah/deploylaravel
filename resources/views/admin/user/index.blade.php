@extends('layouts.app')

@section('title', 'Manage Users |')


@section('content')
<div class="header pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="col-md-12">
            <h1 class="display-2 ">Administrator</h1>
        </div>
        <div class="header-body">{{ Breadcrumbs::render('admin.user.index') }}</div>
    </div>
</div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div id="contacts">
                    <div class="card-header table-responsive border-0">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h3 class="mb-0">{{ __('Users') }}</h3>
                            </div>
                            <div class="col-5">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control search" placeholder="Search" type="text">
                                </div>     
                            </div>
                            <div class="col-md-2 text-md-right text-left py-2">
                                                           
                                <a href="{{ route('user.export') }}" class="btn btn-sm btn-primary inline">{{ __('Generate Report') }}</a>
                            </div>
                            <div class="col-1 text-md-right text-left">
                                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                            </div>
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

                    <div class="table-responsive">
                        <table class="table table-responsive-md align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="no" style="cursor: pointer;width: 10px;">No.<span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort " data-sort="name" style="width: 23%;cursor: pointer;" scope="col">{{ __('Name') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="unikl" style="cursor: pointer;" scope="col">{{ __('UniKL ID') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="email" style="cursor: pointer;" scope="col">{{ __('Email') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="phone" style="cursor: pointer;" scope="col">{{ __('Phone') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="creation" style="cursor: pointer;" scope="col">{{ __('Creation Date') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="no">{{ $no=$no+1 }}</td>
                                        <td class="name text-truncate">{{ $user->name }}</td>
                                        <td class="unikl">{{ $user->unikl_id }}</td>
                                        <td class="email text-truncate">
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td class="phone">{{$user->phone_no}}</td>
                                        <td class="creation">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if ($user->id != auth()->id())
                                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            
                                                            <a class="dropdown-item" href="{{ route('admin.user.edit', $user) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                    @endif
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
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
        @section('loadlist')
    <script src="{{ asset('argon') }}/js/sortuser.js"></script>
    @endsection
@endsection