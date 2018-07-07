@extends('layouts.app')

@section('content')
<div class="container mt-1">
	<div class="row">
		<div class="col-12 col-sm-8 offset-sm-2">
			<div class="card bg-dark text-white">
				<div class="card-header">
					<h3 class="text-center"><i class="fa fa-pencil"></i> Create Form of <code><b>District Name</b></code> </h3>
				</div>
				<div class="card-body">
			  		@include('district._form')
				</div>
			</div>
		</div>
	</div>	
</div>	
@endsection