@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
	    <div class="col-sm-12">
	        <h3>
	            <i class="fa fa-list-ul"></i>
	            List of Products

	            <a href="{{ url('product/create') }}" class="btn btn-outline-primary pull-right">
	                <i class="fa fa-plus"></i> Create <b>Prodict</b>
	            </a>
	        </h3>
	        <div class="card bg-dark text-white">
	            <div class="card-header">
	                <h3 class="text-center"><i class="fa fa-list-ul"></i> List of <code><b>Products</b></code></h3>
	            </div>
	            <div class="card-body">
	            	<div class="table-responsive">
		                <table id="myTable" class="table table-striped table-bordered table-hover">
		                    <thead>
		                        <tr class="success">
		                            <th>SL</th>
		                            <th>Product Name</th>
		                            <th>SKU</th>
		                            <th>Brand Name</th>
		                            <th>Edit</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($products as $product)
		                        <tr>
		                            <td>{{ ++$i }}</td>
		                            <td>{{ $product->name }}</td>
		                            <td>{{ $product->sku }}</td>
		                            <td>{{ $product->brand->name }}</td>
		                            <td>{!! Html::link("product/$product->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-outline-success btn-xs text-white']) !!}</td>  
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