@extends('layouts.blank')


@section('main_container')
<!-- page content -->
<div class="right_col" role="main">

  <div class="container">

    <div class="leave_header">
      <h1>Edit Leave</h1>
    </div>

    <!-- if there are creation errors, they will show here -->
        {{-- <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div> --}}
          {{ Html::ul($errors->all()) }}

          {{-- {{ Form::open(array('url' => '/leaves')) }} --}}
          {{-- a --}}

          <form class="form-horizontal leave_form" method="POST" action="/leave/{{$leave->leave_id}}"    enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PUT">
            {{ csrf_field() }}
            
            <div class="form-group">
              <label class="col-md-1" for="date_begin">Start Date</label>
              <div class="col-md-4">
                @if ($leave->status_name == "Approved")
                <p>{{ Carbon\Carbon::parse($leave->date_begin)->format('d M, Y') }}</p>
                @else
                {{ Form::date('date_begin', $leave->date_begin, array('class' => 'form-control', 'input-md')) }}
                @endif
                {{-- <input value="{{ \Carbon\Carbon::now() }} " id="date_begin" type="date" name="date_begin" class="form-control input-md" required> --}}
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-1 for="date_end">End Date</label>
              <div class="col-md-4">
                @if ($leave->status_name == "Approved")
                <p>{{ Carbon\Carbon::parse($leave->date_begin)->format('d M, Y') }}</p>
                @else
                {{ Form::date('date_end', $leave->date_end, array('class' => 'form-control', 'input-md')) }}
                @endif

                {{-- <input id="date_end" type="date" name="date_end" class="form-control" value="{{ \Carbon\Carbon::now() }}" required> --}}
              </div>
            </div>

            {{-- {{ $begin = Carbon::parse($request->input('date_begin')); }}
            {{ $end = Carbon::parse($request->input('end_date')); }}
            {{ $length = $end->diffInDays($begin); }} --}}

            {{-- <div class="form-group">
                <label class="col-md-1 for="duration">Duration</label>
                <div class="col-md-4">
                    <input id="duration" type="number" name="duration" class="form-control" value="{{ old('date_begin') }}" required>
                </div>
              </div> --}}

              {{-- <div class="form-group">
                <label class="col-md-1 for="leave_categories">Type of Leave</label>
                <div class="col-md-4">
                  <select class="form-control" name="leave_categories">
                    @if ($leave->status_name == "Approved")
                    <p>{{ $leave->leave_name }}</p>
                    @else
                    @foreach($leave_categories as $leave_categories)
                    <option value="{{$leave_categories->leave_type}}" {{ ($leave_categories->name == $leave->leave_name ? "selected":"") }}>{{$leave_categories->name}}</option>
                    @endforeach
                    @endif
                    
                  </select>
                </div>
              </div> --}}

              <div class="form-group">
                <label class="col-md-1 for="reason">Reason</label>
                <div class="col-md-4">
                  @if ($leave->status_name == "Approved")
                  <p>{{ $leave->reason }}</p>
                  @else
                  <textarea class="form-control" name="reason" id="reason" required>{{ $leave->reason }}</textarea>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-1 for="attachment">Attachment (if any)</label>
                <div class="col-md-4">
                  @if ($leave->status_name == "Approved")
                    @if ($leave->attachment == NULL)
                    <p>No attachment</p>
                    @else 
                    <img class="img-responsive" src="{{ asset("$leave->attachment") }}" alt="{{ $leave->attachment }}" >
                  @endif
                  @else
                  <input class="form-control" name="attachment" id="attachment" type="file">
                  @endif
                  
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-1 for="status">Status</label>
                <div class="col-md-4">
                  <b><p>{{ $leave->status_name }}</p></b>
                </div>


              </div>  

              <div class="form-group">
                <label class="col-md-1 for="hr_appr">HR Department</label>
                <div class="col-md-4">
                  @if (Auth::user()->access_level == "HR Department")
                  {{  Form::select('hr_appr', array('1' => 'Pending', '2' => 'Approve', '3' => 'Reject'), '1', ['class' => 'form-control'])}}
                  @else
                  {{  Form::select('hr_appr', array('1' => 'Pending', '2' => 'Approve', '3' => 'Reject'), '1', ['class' => 'form-control', 'disabled' => 'true'])}}
                  @endif
                  

                  {{-- <select class="form-control" name="hr_appr" disabled>
                    <option value="1">Pending</option>
                    <option value="2">Approve</option>
                    <option value="3">Reject</option>
                  </select> --}}
                  {{-- <input class="checkbox" type="checkbox" name="hr_appr" disabled> --}}
                </div>
              </div> 
              <div class="form-group">
                <label class="col-md-1 for="gm_appr">General Manager</label>
                <div class="col-md-4">
                  @if (Auth::user()->access_level == "General Manager")
                  {{  Form::select('gm_appr', array('1' => 'Pending', '2' => 'Approve', '3' => 'Reject'), '1', ['class' => 'form-control', 'disabled' => 'true'])}}
                  @else
                  {{  Form::select('gm_appr', array('1' => 'Pending', '2' => 'Approve', '3' => 'Reject'), '1', ['class' => 'form-control', 'disabled' => 'true'])}}
                  @endif
                  
                  {{-- <select class="form-control" name="gm_appr" disabled>
                    <option value="1">Pending</option>
                    <option value="2">Approve</option>
                    <option value="3">Reject</option>
                  </select> --}}
                  {{-- <input class="checkbox" type="checkbox" name="gm_appr" disabled> --}}
                </div>
              </div> 
              <div class="form-group">
                <label class="col-md-1 for="dr_appr">Director</label>
                <div class="col-md-4">
                  @if (Auth::user()->access_level == "General Manager")
                  {{  Form::select('dr_appr', array('1' => 'Pending', '2' => 'Approve', '3' => 'Reject'), '1', ['class' => 'form-control'])}}
                  @else
                  {{  Form::select('dr_appr', array('1' => 'Pending', '2' => 'Approve', '3' => 'Reject'), '1', ['class' => 'form-control', 'disabled' => 'true'])}}
                  @endif
                  {{-- <select class="form-control" name="dr_appr" disabled>
                    <option value="1">Pending</option>
                    <option value="2">Approve</option>
                    <option value="3">Reject</option>
                  </select> --}}
                  {{-- <input class="checkbox" type="checkbox" name="dr_appr" disabled> --}}
                </div>
              </div> 

              <div class="form-group">
                <label class="col-md-1 for="remarks">Remarks</label>
                <div class="col-md-4">
                  <textarea class="form-control" name="remarks" id="remarks" disabled></textarea>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label class="col-md-1"></label>
                <div class="col-md-4">
                  <button type="submit" class="form-button btn btn-primary btn-round-lg">SAVE</button>
                </div>
              </div>
              <br>
            </div>
          </div>
          @endsection


