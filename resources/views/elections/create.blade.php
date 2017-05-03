@extends('admin-home')
 @section('content-create-election')
  <form class="form-horizontal" method="POST" action="/admin_home/elections">
    {{ csrf_field() }};
    <fieldset>

    <!-- Form Name -->
      <legend>New Election</legend>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="election_name">Election Title</label>
        <div class="col-md-5">
        <input id="election_name" name="election_name" type="text" placeholder="Election title" class="form-control input-md" required="">
        <span class="help-block">help text goes here</span>
        </div>
      </div>

      <!-- Text input -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="election_desc">Election Description</label>
        <div class="col-md-5">
        <textarea id="election_desc" name="election_desc" type="text" placeholder="Election Description" class="form-control input-md" required=""></textarea>
        <span class="help-block">help text goes here</span>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group"> 
        <label class="col-md-4 control-label" for="start_date">Start Date</label>
        <div class="col-md-4">
        <input id="start_date" name="start_date" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">

        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="close_date">End Date</label>
        <div class="col-md-4">
        <input id="close_date" name="close_date" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">

        </div>
      </div>


      <!-- Select -->
      <div id = "candidate_select">
        <label for="num_candidates">How many Candidates? </label>
        <select id="num_candidates" name="num_candidates" onchange="cand_generate()">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>

      <!-- Text Input -->
      <div id ="candidate_form">
        <fieldset class="candidate_field[1]">
          <legend>Candidate #1</legend>
          <input type="file" name="cand_image[1]">
          <label>Please choose an image of the candidate to upload</label>
          <br>
          <div>
          <label>Candidate Name: </label><input type="text" name="cand_name[1]">
          </div>
          <br>
          <label>Affiliated Political Party: </label><input type="text" name="cand_pparty[1]">
          <br>
          <label>Candidate Description: </label><input type="tex" name="cand_desc[1]">
          <br>
        </fieldset>
       </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="Submit"></label>
        <div class="col-md-4">
          <button id="Submit" name="Submit" class="btn btn-default">Submit</button>
        </div>
      </div>

    </fieldset>
  </form>
@endsection
