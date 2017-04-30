@extends('layouts.app')
@section('content')


<script type="text/javascript">
  //nino validation
  function checkNINO (toCheck) {
    var regex = /^(?!BG|GB|NK|KN|TN|NT|ZZ)[A-CEGHJ-PR-TW-Z][A-CEGHJ-NPR-TW-Z](?:\s*\d{2}){3}\s*[A-D]$/;
    return regex.test(toCheck);
  }
</script>


  <p1>
   <form class="form-horizontal" method="post" action="\">
     {{csrf_field()}}
    <fieldset>

      <!-- Form Name -->
      <legend style="text-align: center;">Enter your credentials below to register your vote.</legend>

      <!-- NI number input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="natioalinsuranceno">National Insurance Number</label>
        <div class="col-md-4">
        <input id="natioalinsuranceno" name="natioalinsuranceno" type="text" placeholder="National Insurance Number" class="form-control input-md" required="">
        <span class="help-block"></span>
        </div>
      </div>

      <!-- DOB input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="dateofbirth">Date Of Birth:</label>
        <div class="col-md-4">
        <input id="dateofbirth" name="dateofbirth" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">
        <span class="help-block"></span>
        </div>
      </div>

      <!-- VAC input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="votecode">Voting Code</label>
        <div class="col-md-4">
          <input id="votecode" name="votecode" type="password" placeholder="Voting Code" class="form-control input-md" required="">
          <span id="nino-error"></span>
          <span class="help-block" style="padding-left:1em; padding-right:1em;">This is the code shown on your polling card. Your polling card will have been sent to you in the post</span>
        </div>
      </div>


      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="login"></label>
        <div class="col-md-4">
          <button id="login" name="login" class="btn btn-primary">Log in</button>
        </div>
      </div>

      <!-- Failed Auth -->
      @if (isset( $error ))
      <script type="text/javascript">alert('Login Failed - Invalid Credentials.\nPlease try again')</script>
      @endif
    </fieldset>
   </form>
  </p1>
@endsection
