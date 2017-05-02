@extends('layouts.app')
@section('content')
<!-- select box styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>


<script type="text/javascript">

  function validateForm(){
    //TODO
    var nino = document.forms["login"]["nationalinsuranceno"].value.replace(/\s+/g, '');;
    var dob = document.forms["login"]["dateofbirth"].value.replace(/\s+/g, '');
    var vac = document.forms["login"]["votecode"].value.replace(/\s+/g, '');


  }

  //nino validation
  function checkNINO (toCheck) {
    var regex = /^(?!BG|GB|NK|KN|TN|NT|ZZ)[A-CEGHJ-PR-TW-Z][A-CEGHJ-NPR-TW-Z](?:\s*\d{2}){3}\s*[A-D]$/;
    return regex.test(toCheck);
  }
</script>


  <p1>
   <form class="form-horizontal" name="login" method="post" action="\" onsubmit="return validateForm()">
     {{csrf_field()}}
    <fieldset>
      {{csrf_field()}}
      <!-- Form Title -->
      <legend style="text-align: center;">Enter your credentials below to cast your ballot</legend>

      <!-- NI number input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="nationalinsuranceno">National Insurance Number</label>
        <div class="col-md-4">
        <input id="nationalinsuranceno" name="nationalinsuranceno" type="text" placeholder="National Insurance Number" class="form-control input-md" required="">
        
        <span id="nino-error"></span>
        </div>
      </div>

      <!-- DOB input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="dateofbirth">Date Of Birth:</label>

        <div class="col-md-4" style="margin-left: -1em;"> <!-- hack to get alignment -->
        <span class="col-xs-4">

        <!-- Day -->
        <select name="dob-day" id="dob-day" class="form-control">
            <option value="">Day</option>
            <option value="">---</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>
        </span>

        <!-- Month -->
        <span class="col-xs-4">
        <select name="dob-month" id="dob-month" class="form-control">
            <option value="">Month</option>
            <option value="">-----</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        </span>
      
      <!-- Year -->  
      <span class="col-xs-4">
        <input type="text" name="dob-year" id="dob-year" placeholder="Year" class="form-control input-md">
        </span>
        <span class="help-block"></span>
        </div>
      </div>

      <!-- VAC input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="votecode">Voting Code</label>
        <div class="col-md-4">
          <input id="votecode" name="votecode" type="text" placeholder="Voting Code" class="form-control input-md" required="">
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
