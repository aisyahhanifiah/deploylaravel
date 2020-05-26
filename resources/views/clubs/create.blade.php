@extends('layouts.blank')

@section('title', 'Submit a Photo')

@section('main_container')
<div class="ui equal width grid">
  <div class="row">
    <div class="column">
    </div>
    <div class="eight wide column editprofile">
      <form class="ui form" method="POST" action="{{ route('photo.create') }}" enctype="multipart/form-data">
        <h3>Submit a photo</h3>
        {{ csrf_field() }}
        <div class="two fields">
          <div class="field">
            <img class="ui image big" id="img" src="https://semantic-ui.com/images/wireframe/image.png">
          </div>
          <div>
            <input type="file" id="image" class="inputfile"  name="image"/>
            <label for="image" class="ui basic button">
              <i class="ui upload icon"></i> 
              Upload image
            </label>
          </div>
        </div>
        <div class="field">
          <label>Caption</label>
          <textarea rows="2" name="description"></textarea>
        </div>
        <input class="ui black submit button" id="submit" type="submit" value="Submit This Photo" name="submit"></input>
        <div class="ui error message"></div>

      </form>
    </div>
    <div class="column">
    </div>
  </div>
</div>


          @endsection

