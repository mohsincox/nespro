<!DOCTYPE html>
<html>
<head>
	<title>CRM Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
	
	<style type="text/css">
        .btn-group-xs > .btn, .btn-xs {
            padding  : .25rem .4rem;
            font-size  : .875rem;
            line-height  : .5;
            border-radius : .2rem;
        }
        .alert {
            padding: 2px; 
            margin-bottom: 0px; 
        }
        .input-group>.input-group-prepend {
		    flex: 0 0 40%;
		}
		.input-group .input-group-text {
		    width: 100%;
		}
    </style>
</head>
<body>
	<div class="container-fluid mt-1">
	    <div class="row">
	        <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
	            <div class="card bg-dark text-white">
	                <div class="card-header text-center" style="padding: 0px;">
	                    Nestle Inbound CRM <small><?php echo 'Phone No: <mark>'.'$phone_number'; ?></mark></small> & <small><?php echo 'Agent: <mark>'.'$agent'; ?></mark></small>
	                </div>

	                <div class="card-body" style="padding: 5px;">
	                    {!! Form::open(['url' => 'foo/bar', 'method' => 'get']) !!}
	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Name</span>
	                                    </div>
	                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Division</span>
	                                    </div>
	                                    {!! Form::select('division', $divisionList, null, ['class' => 'form-control','placeholder' => 'Select Division', 'id' => 'division_id']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">District</span>
	                                    </div>
	                                    <!-- {!! Form::select('district', $districtList, null, ['class' => 'form-control bg-danger text-white','placeholder' => 'Select District Name (at first select Division)', 'disabled' => 'disabled', 'id' => 'hide_district']) !!} -->
	                                    
	                                    <span id="division_district_show"></span>
	                                </div>
	                            </div>

	                        </div>
	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Police Station</span>
	                                    </div>
	                                    <!-- {!! Form::select('police_station', $policeStationList, null, ['class' => 'form-control','placeholder' => 'Select Police Station', 'id' => 'hide_ps']) !!} -->

	                                    <span id="district_ps_show"></span>
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Alternative Phone</span>
	                                    </div>
	                                    {!! Form::text('alternative_phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Alternative Phone', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">ECO</span>
	                                    </div>
	                                    {!! Form::text('eco', null, ['class' => 'form-control', 'placeholder' => 'Enter Alternative Phone', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">Number of Child</span>
	                                    </div>
	                                    {!! Form::select('number_of_child', ['1' => '1', '2' => '2', '3' => '3'], null, ['class' => 'form-control','placeholder' => 'Select Number of Child']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">1st Child Name</span>
	                                    </div>
	                                    {!! Form::text('1st_child_name', null, ['class' => 'form-control', 'placeholder' => 'Enter 1st Child Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">1st Child Gender</span>
	                                    </div>
	                                    {!! Form::select('1st_child_gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control','placeholder' => 'Select 1st Child Gender']) !!}
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">1st Child DOB</span>
	                                    </div>
	                                    {!! Form::text('1st_child_date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Enter 1st Child Date of Birth', 'autocomplete' => 'off', 'id' => '1st_child_date_of_birth', 'readonly' => 'readonly']) !!}
	                                    <span id="1st_child_date_of_birth_show"></span>
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">2nd Child Name</span>
	                                    </div>
	                                    {!! Form::text('2nd_child_name', null, ['class' => 'form-control', 'placeholder' => 'Enter 1st Child Name', 'autocomplete' => 'off']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">2nd Child Gender</span>
	                                    </div>
	                                    {!! Form::select('2nd_child_gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'placeholder' => 'Select 2nd Child Gender']) !!}
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">2nd Child DOB</span>
	                                    </div>
	                                    {!! Form::text('2nd_child_date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Enter 2nd Child Date of Birth', 'autocomplete' => 'off', 'id' => '2nd_child_date_of_birth', 'readonly' => 'readonly']) !!}
	                                    <span id="2nd_child_date_of_birth_show"></span>
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">1st Prefered Brand</span>
	                                    </div>
	                                    {!! Form::select('1st_prefered_brand', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'placeholder' => 'Select 1st Prefered Brand']) !!}
	                                </div>
	                            </div>
	                            <div class="col-sm-4" style="padding-left: 10px; padding-right: 10px;">
	                                <div class="input-group mb-2 input-group-sm">
	                                    <div class="input-group-prepend">
	                                        <span class="input-group-text bg-success text-white">2nd Prefered Brand</span>
	                                    </div>
	                                    {!! Form::select('2nd_prefered_brand', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control', 'placeholder' => 'Select 2nd Prefered Brand']) !!}
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                        	<div class="col-sm-4">
	                        		<div class="input-group input-group-sm" style="margin-top: 5px;">
					      			<span class="input-group-addon" style="background-color: #59a3ef; color: #FFFFFF">Q2.1. Give Rating Outlet? </span>
					      			{!! Form::select('Q2_1GiveRatingOutletMid', [], null, ['class' => 'form-control','placeholder' => 'Select Q2.1. Give Rating Outlet?', 'id' => 'Q2_1GiveRatingOutletMid']) !!}
					    		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="input-group input-group-sm" style="margin-top: 5px;">
						      			<span class="input-group-addon" style="background-color: #59a3ef; color: #FFFFFF">Q2.2. Give Rating Delivary? </span>
						      			{!! Form::select('Q2_2GiveRatingDelivaryMid', [], null, ['class' => 'form-control','placeholder' => 'Select Q2.2. Give Rating Delivary?', 'id' => 'Q2_2GiveRatingDelivaryMid']) !!}
						    		</div>
	                        	</div>
	                        	<div class="col-sm-4">
	                        		<div class="input-group input-group-sm" style="margin-top: 5px;">
						      			<span class="input-group-addon" style="background-color: #59a3ef; color: #FFFFFF">Q2.3. Give Rating Installation? </span>
						      			{!! Form::select('Q2_3GiveRatingInstallationMid', [], null, ['class' => 'form-control','placeholder' => 'Select Q2.3. Give Rating Installation?', 'id' => 'Q2_3GiveRatingInstallationMid']) !!}
						    		</div>
	                        	</div>
	                        </div>
						{!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $( function() {
            // $( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });
            // $( "#datepicker" ).datepicker( "setDate", "0" );
            $( "#1st_child_date_of_birth" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#1st_child_date_of_birth" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            $( "#2nd_child_date_of_birth" ).datepicker({ changeMonth: true, changeYear: true, maxDate: +0 });
            $( "#2nd_child_date_of_birth" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        });

        $(document).ready(function(){
            $("#1st_child_date_of_birth").change(function(){
                var dateOfBirth = $("#1st_child_date_of_birth").val();
                var url = '{{ url("/crm-profile/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#1st_child_date_of_birth_show').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#2nd_child_date_of_birth").change(function(){
                var dateOfBirth = $("#2nd_child_date_of_birth").val();
                var url = '{{ url("/crm-profile/get-ymd")}}';
                $.get(url+'?dateOfBirth='+dateOfBirth, function (data) {
                    $('#2nd_child_date_of_birth_show').html(data);
                });
            });
        });

        $(document).ready(function(){
		    $("#division_id").change(function(){
		        var divisionId = $("#division_id").val();
		        var url = '{{ url("/crm-profile/division-district-show")}}';
		        $.get(url+'?division_id='+divisionId, function (data) {
		        	$("#hide_district").hide();
	            	$('#division_district_show').html(data);
	            	$('#district_ps_show').html('<select class="form-control" name="police_station_id"><option value="">Select Police Station</option></select>');
	        	});
		    });
		});
    </script>
</body>
</html>