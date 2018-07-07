@extends('layouts.app')

@section('content')
<div class="container mt-1">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    {!! Form::open(['url' => 'foo/bar']) !!}
    					{!! Form::text('email', 'example@gmail.com') !!}
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
