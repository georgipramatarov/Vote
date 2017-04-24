@extends('admin-home')
 @section('content-create-election')
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>New Election</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Election_title">Election Title</label>
  <div class="col-md-5">
  <input id="Election_title" name="Election_title" type="text" placeholder="Election title" class="form-control input-md" required="">
  <span class="help-block">help text goes here</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="startdate">Start Date</label>
  <div class="col-md-4">
  <input id="startdate" name="startdate" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="enddate">End Date</label>
  <div class="col-md-4">
  <input id="enddate" name="enddate" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">

  </div>
</div>


<!-- Select -->
<div id = "candidate_select">
  <label>How many Candidates? </label>
  <select id="num_cands" onchange="cand_generate()">
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
