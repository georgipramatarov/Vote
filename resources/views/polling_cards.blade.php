@extends('admin-home')

@section('security')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<script type="text/javascript">
	//automatically enables limit text box
	$(function(){
        $('#count').attr('disabled',true);
        $('#limit').click(function(){
            $('#count').attr('disabled',!this.checked);
        });
        $('#genAllCards').submit(function(){
            return $('#limit').attr('checked');
        });
    });
  		
</script>

<!-- error/confirmation alerts -->
@if (isset($_SESSION['cardsCreated']) && $_SESSION['cardsCreated']==1) <!-- Generated all -->
    <Script>alert("Polling cards sucessfully generated.")</Script>
    <?php unset($_SESSION['cardsCreated']) ?>
@endif

@if (isset($_SESSION['cardError']) && $_SESSION['cardError']==1) <!-- Invalid nino -->
    <Script>alert("Error - National insurance number not found")</Script>
    <?php unset($_SESSION['cardError']) ?>
@endif

@if (isset($_SESSION['cardError']) && $_SESSION['cardError']==2) <!-- Invalid limit input -->
    <Script>alert("Error - Limit value is not numeric.")</Script>
    <?php unset($_SESSION['cardError']) ?>
@endif

<!-- Generate all/first x -->
<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Generate All Polling Cards</div>
                
                <div class="panel-body">
                From here you can generate all of the polling cards for registered voters as PDF files.

                <form id="genAllCards" method="GET" action="{{ url('admin_home/pollingcards/generate') }}">
                <div class="form-group" style="padding-left:1em; padding-top: 1em;">
                	
                	<div class="form-group">

                		<input type="checkbox" name="limit" id="limit" value="yes">
                	    <label for="limit">Limit</label>

                		<input type="text" name="count" value="1" id="count" style="margin-left: 1em;">
                		
                		<span class="help-block" style="margin-left: 1em;">
                			Limit the amount of polling cards generated for testing purposes.
                		</span>

                		<input type="checkbox" name="zip" id="zip" value="1"  checked>
                		<label for="zip">Download ZIP</label>
                		<span class="help-block" style="margin-left: 1em;">
                			Download all of the polling cards as a ZIP archive.
                		</span>
                	</div>
                	


                </div>
             
                <button method="GET" type ="submit" class="btn btn-primary">Generate</button>
                </form>

            	</div>
      		</div>
		</div>

<!-- Generate one -->
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Generate One Polling Card</div>
                
                <div class="panel-body">
                From here you can generate one polling card from a national insurance number.

                <form id="genAllCards" method="GET" action="{{ url('admin_home/pollingcards/generateone') }}">
                <div class="form-group" style="padding-left:1em; padding-top: 1em;">
                    
                    <div class="form-group">

                        <label for="nino">NI Number:</label>

                        <input type="text" name="nino" id="count" style="margin-left: 1em;">
                        </span>
                    </div>
                
                </div>
             
                <button method="GET" type ="submit" class="btn btn-primary">Generate</button>
                </form>

                </div>
            </div>
        </div>


<!-- Send polling Cards -->
<div class="col-md-0">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgray">Send Polling Cards</div>
        <div class="panel-body">
            From here you can send polling cards out to registered voters.
            <div class="form-group">
        	   <button method="post" type ="submit" class="btn btn-primary" disabled="true" name = "Grant">Send</button>
            </div>
        </div>
      </div>
</div>
</div>

@endsection
