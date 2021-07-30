@extends('admin.layouts.app')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-block dashboard">
    <div class="title-section d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">
		<div class="text-block">
            <h3>PAYMENT TYPE SECTION</h3>
			<h1 class="title">New Payment Type Create</h1>
		</div>
		<div class="btn-block">
			<a class="btn btn-primary" href="{{ route('payment.type.index') }}">
                <ion-icon name="list-outline"></ion-icon>
				<span>Payment Type List</span>
			</a>
		</div>
	</div>
	<div class="form-block">
        {!! Form::open(array('route' => 'payment.type.store', 'method'=> 'POST', 'class'=> 'row g-3', 'enctype' => 'multipart/form-data')) !!}
            @csrf
            <div class="col-md-8">
                {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @if($errors->has('name'))
                    <div class="error_msg">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        {!! Form::close() !!}
    </div>
</main>
@endsection
