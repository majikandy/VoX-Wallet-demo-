@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<section id="content">
                <div class="breadcrumb"><a href="/withdraw">Withdraw</a> > Withdraw to bank account</div>
								<div id="content__grid" data-columns>
	                <form action="/withdrawToBankAttempt" method="POST" id="withdrawToBankAttempt">
	                    {{ csrf_field() }}


	                    <div class="form-group">
	                        <label for="name">Full name*</label>
	                        <input type="text" class="form-control" id="name" value="{{Auth::user()->name}}" name="name" required>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-7">
	                            <div class="form-group">
	                                <label for="sortCode">Sort Code [eg 11-22-33]</label>
	                                <input type="text" class="form-control" id="sortCode" name="sortCode" value="13-81-72" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}">
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-md-7">
	                            <div class="form-group">
	                                <label for="sortCode">Account Number [eg 00112233]</label>
	                                <input type="text" class="form-control" id="accountNumber" name="accountNumber" value="05641123" pattern="[0-9]{8}">
	                            </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                            <div class="col-md-7">
	                                <div class="form-group">
		                                  <label for="sortCode">Amount in VoX</label>
																			<div class="input-group">
													                <input type="number" step="any" min="0.01" max="{{$balance}}" placeholder="50" class="form-control" id="voxAmount" name="voxAmount">
													                <input type="hidden" value="{{$balance}}" id="userBalance">
													                <span class="input-group-btn">
													                    <button id="withdrawMax" type="button" class="btn btn-default" style="padding:7.5px">Withdraw max</button>
													                </span>
													            </div>
																	</div>
	                            </div>
	                        </div>
	                    <button type="submit" class="btn btn-primary">Withdraw now</button>
	                </form>
							</div>
		</section>

		<script>
		  $(document).ready(function(){
		    $("#withdrawMax").click(function() {
					var balance = $("#userBalance").val();
					console.log("balance", balance);
		       $("#voxAmount").val(balance);
		    });
			});
		</script>

@endsection
