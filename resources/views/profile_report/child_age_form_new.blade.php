@extends('layouts.app')

@section('content')
<div class="container mt-1">
	    <div class="row">
	        <div class="col-sm-6 offset-sm-3">
	            <div class="card bg-dark text-white">
	                <div class="card-header">Child Age Report</div>
	                <div class="card-body">
	                    {!! Form::open(['url' => 'profile-report/child-age-show-new', 'method' => 'post', 'class' => 'form-horizontal']) !!}
	                        
							<div class="required form-group {{ $errors->has('from_year') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('from_year', 'From', ['class' => 'col-3 col-sm-3 control-label']) !!}
							        <div class="col-9 col-sm-9">
							        	<div class="row">
								        	<div class="col-6 col-sm-6">
								    	        {!! Form::select('from_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control','placeholder' => 'Select Year']) !!}
								    	        <span class="text-danger">
								    			    {{ $errors->first('from_year') }}
								    		    </span>
								    		</div>
								    		<div class="col-6 col-sm-6">
								    	        {!! Form::select('from_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control','placeholder' => 'Select Month']) !!}
								    	        <span class="text-danger">
								    			    {{ $errors->first('from_month') }}
								    		    </span>
								    		</div>
							    		</div>
							        </div>
							    </div>
							</div>

	                        <div class="required form-group {{ $errors->has('to_year') ? 'has-error' : ''}}">
							    <div class="row"> 
							        {!! Form::label('to_year', 'To', ['class' => 'col-3 col-sm-3 control-label']) !!}
							        <div class="col-9 col-sm-9">
							        	<div class="row">
								        	<div class="col-6 col-sm-6">
								    	        {!! Form::select('to_year', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06'], null, ['class' => 'form-control','placeholder' => 'Select Year']) !!}
								    	        <span class="text-danger">
								    			    {{ $errors->first('to_year') }}
								    		    </span>
								    		</div>
								    		<div class="col-6 col-sm-6">
								    	        {!! Form::select('to_month', ['0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06','7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11'], null, ['class' => 'form-control','placeholder' => 'Select Month']) !!}
								    	        <span class="text-danger">
								    			    {{ $errors->first('to_month') }}
								    		    </span>
								    		</div>
							    		</div>
							        </div>
							    </div>
							</div>

	                        <div class="form-group">
	                        	<div class="row">
	                            <div class="col-sm-9 offset-sm-3">
	                                {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-block text-white']) !!}
	                            </div>
	                            </div>
	                        </div>
	                    {!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>	
@endsection

@section('style')
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
@endsection

@section('script')
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
		$( function() {
			$( "#start_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#start_date" ).datepicker( "setDate", "0" );
        	$( "#end_date" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", maxDate: +0 });
        	$( "#end_date" ).datepicker( "setDate", "0" );
        	$( "#child_start_date" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child_start_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $( "#child_end_date" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#child_end_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		} );

		$(document).ready(function(){
            $("#child_start_date").change(function(){
                var dateOfBirth = $("#child_start_date").val();
                var url = '{{ url("/profile-report/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child_start_age_show').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#child_end_date").change(function(){
                var dateOfBirth = $("#child_end_date").val();
                var url = '{{ url("/profile-report/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#child_end_age_show').html(data);
                });
            });
        });
	</script>
@endsection