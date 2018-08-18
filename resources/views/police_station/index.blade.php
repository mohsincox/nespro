@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <div class="row">
		    	<div class="col-sm-7">
		        		<h3><i class="fa fa-list-ul"></i> List of Police Station Names</h3>
		        </div>
	        	<div class="col-sm-5">
	        		<a href="{{ url('police-station/create') }}" class="btn btn-outline-primary pull-right">
	                	<i class="fa fa-plus"></i> Create <b>Police Station Name</b>
	            	</a>
		    	</div>
	        </div>
	        <div class="card">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Police Station Names</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
		                <table id="myTable" class="table table-striped table-bordered table-hover">
		                    <thead>
		                        <tr class="">
		                            <th>SL</th>
		                            <th>#</th>
		                            <th>Police Station Name</th>
		                            <th>District Name</th>
		                            <th>Division Name</th>
		                            <th>Edit</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($policeStations as $policeStation)
		                        <tr>
		                            <td>{{ ++$i }}</td>
		                            <td>{{ $policeStation->id }}</td>
		                            <td>{{ $policeStation->name }}</td>
		                            <td>{{ $policeStation->district->name }}</td>
		                            <td>{{ $policeStation->division->name }}</td>
		                            <td>{!! Html::link("police-station/$policeStation->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs']) !!}</td>  
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