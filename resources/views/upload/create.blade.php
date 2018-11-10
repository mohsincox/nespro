@extends('layouts.app')

@section('content')
<div class="container mt-1" style="height: 500px;">
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2">
			<div class="card">
				<div class="card-header">
					<h3 class="text-center"><i class="fa fa-pencil"></i> Upload Form of <code><b>Eecel</b></code> File</h3>
				</div>
				<div class="card-body">
			  		
	    			{!! Form::open(['url' => 'upload-srore', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'uploadForm', 'enctype' => 'multipart/form-data']) !!}

					<div class="required form-group {{ $errors->has('file') ? 'has-error' : ''}}">
					    <div class="row"> 
					        {!! Form::label('file', 'Profile Excel File', ['class' => 'col-3 col-sm-3 control-label']) !!}
					        <div class="col-9 col-sm-9">
					        	<div class="col-12 col-sm-12">
					    	        {!! Form::file('file', ['class' => 'form-control', 'placeholder' => 'Excel File', 'autocomplete' => 'off']) !!}
					    	        <span class="text-danger">
					    			    {{ $errors->first('file') }}
					    		    </span>
					    		</div>
					        </div>
					    </div>
					</div>

					<div class="form-group">
					    <div class="row">
					        {!! Form::button('Submit', ['class' => 'btn btn-outline-primary btn-block', 'data-toggle' => 'modal', 'data-target' => '#myModal']) !!}
					    </div>
					</div>

					<div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog"> 
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirmation Message</h4>
                                </div>
                                <div class="modal-body">
                                    <h3 class="text-center">Want to <b>create a Ticket</b>?</h3>
                                </div>
                                <div class="modal-footer bg-success">   
                                    {!! Form::submit('YES', ['class' => 'btn btn-primary btn-block submitBtnUpload']) !!}
                                </div>
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

@section('script')
	<script type="text/javascript">
		$(document).ready(function () {
            $("#uploadForm").submit(function () {
                $(".submitBtnUpload").attr("disabled", true);
                return true;
            });
        });
	</script>
@endsection