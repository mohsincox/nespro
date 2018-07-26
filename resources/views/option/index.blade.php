@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <h3>
	            <i class="fa fa-list-ul"></i>
	            List of Options

	            <a href="{{ url('option/create') }}" class="btn btn-outline-primary pull-right">
	                <i class="fa fa-plus"></i> Create <b>Option</b>
	            </a>
	        </h3>
	        <div class="card bg-dark text-white">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Options</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
		                <table id="myTable" class="table table-striped table-bordered table-hover">
		                    <thead>
		                        <tr class="success">
		                            <th>SL</th>
		                            <th>Option Name</th>
		                            <th>Select Name</th>
		                            <th>Status</th>
		                            <th>Edit</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($options as $option)
		                        <tr>
		                            <td>{{ ++$i }}</td>
		                            <td>{{ $option->name }}</td>
		                            <td>{{ $option->select->name }}</td>
		                            <td>{{ $option->status }}</td>
		                            <td>{!! Html::link("option/$option->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs text-white']) !!}</td>  
		                        </tr>
		                    @endforeach
		                    </tbody>
		                </table>
		            </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
@endsection