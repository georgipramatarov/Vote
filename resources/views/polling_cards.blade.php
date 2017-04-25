@extends('admin-home')

@section('security')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<script type="text/javascript">
	
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

<?php 
	session_start();
	
	if (isset($_SESSION['cardsCreated']) and $_SESSION['cardsCreated'] == "1"){
		echo "<script>alert('Polling cards successfully created')</script>";
		unset($_GET['cards']);
	}

	session_destroy();
?>

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
</div>

<!-- generate one -->
<div class="container col-md-8 col-md-offset-0">
        <div class="col-md-0 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:lightgray">Generate One Polling Card</div>
                <div class="panel-body">
                From here you can generate all of the polling cards for registered voters as PDF files.

                <form id="genOneCard">
                	<div class="form-group" style="padding-left:1em; padding-top: 1em;">
                	<label for="nino">National Insurance Number:</label>
                	<input type="text" disabled="true" name="nino">
                	</div>

                	<button method="post" type ="submit" class="btn btn-primary" name = "Grant" disabled="true">Generate</button>
                </form>
            </div>
      </div>
</div>


<div class="col-md-0 ">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:lightgray">Send Polling Cards</div>
        <div class="panel-body">
        From here you can send polling cards out to registered voters. For the prototype polling cards are sent via Email.

        	<button method="post" type ="submit" class="btn btn-primary" disabled="true" name = "Grant">Send</button>
          </div>
      </div>
</div>
</div>

@endsection
