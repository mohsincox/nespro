@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <h3>
	            <i class="fa fa-list-ul"></i>
	            List of Brand Names
		            <a href="{{ url('brand/create') }}" class="btn btn-outline-primary pull-right">
		                <i class="fa fa-plus"></i> Create <b>Brand Name</b>
		            </a>
				
	        </h3>
	        <div class="card bg-dark text-white">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Brand Names</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
	                <table id="myTable" class="table table-bordered table-striped table-hover">
	                    <thead>
	                        <tr class="success">
	                            <th>SL</th>
	                            <th>Brand Names</th>
	                            <th>Edit</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php
	                        $i = 0;
	                    ?>
	                    @foreach($brands as $brand)
	                        <tr>
	                            <td>{{ ++$i }}</td>
	                            <td>{{ $brand->name }}</td>
	                            <td>{!! Html::link("brand/$brand->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs text-white']) !!}</td>
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