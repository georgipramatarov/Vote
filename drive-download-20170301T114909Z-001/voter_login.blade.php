<!DOCTYPE html>
<html>
 @include('includes.head')
<title>Secure Vote</title>
<body>
  <p1>
   <form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Enter your credentials below to register your vote.</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="natioalinsuranceno">National Insurance Number</label>  
  <div class="col-md-4">
  <input id="natioalinsuranceno" name="natioalinsuranceno" type="text" placeholder="National Insurance Number" class="form-control input-md" required="">
  <span class="help-block">help text goes here</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dateofbirth">Date Of Birth:</label>  
  <div class="col-md-4">
  <input id="dateofbirth" name="dateofbirth" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">
  <span class="help-block">Help Text goes here</span>  
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="votecode">Voting Code</label>
  <div class="col-md-4">
    <input id="votecode" name="votecode" type="password" placeholder="Voting Code" class="form-control input-md" required="">
    <span class="help-block">Help Text goes here</span>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="login"></label>
  <div class="col-md-4">
    <button id="login" name="login" class="btn btn-primary">Log in</button>
  </div>
</div>

</fieldset>
</form>
    </p>
  </body>
</html>