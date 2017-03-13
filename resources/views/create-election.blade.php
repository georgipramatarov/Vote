<html>
 @include('includes.head')
<title>Secure Vote - Administrator</title>
<body>
form class="form-horizontal">
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

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Submit"></label>
  <div class="col-md-4">
    <button id="Submit" name="Submit" class="btn btn-default">Submit</button>
  </div>
</div>

</fieldset>
</form>
</body>
</HTML>
