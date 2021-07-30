@extends('admin.layouts.app')

@push('custom-style')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-block dashboard">
    <div class="title-section d-flex justify-content-between align-items-center pt-3 pb-2 mb-3">
		<div class="text-block">
			<h3>TICKET SECTION</h3>
			<h1 class="title">New Ticket Create</h1>
		</div>
		<div class="btn-block">
			<a class="btn btn-primary" href="{{ route('ticket.index') }}">
                <ion-icon name="list-outline"></ion-icon>
				<span>Ticket List</span>
			</a>
		</div>
	</div>
	<div class="form-block">
        {!! Form::open(array('route' => 'ticket.store', 'method'=> 'POST', 'class'=> 'row g-3', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off')) !!}
            @csrf
            <div class="col-md-6 source-id">
                {!! Form::label('source_id', 'Source Name', ['class' => 'form-label']) !!}
                <select name="source_id" id="source_id" class="form-select" onchange="userFormatState('source_id')" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('source_id'))
                    <div class="error_msg">
                        {{ $errors->first('source_id') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card" id="source_id_user">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <img class="p-3" src="{{ asset('images/admin/user-not-found.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('agent_id', 'Agent Name', ['class' => 'form-label']) !!}
                <select name="agent_id" id="agent_id" class="form-select" onchange="userFormatState('agent_id')">
                    <option selected disabled value="">Choose...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('agent_id'))
                    <div class="error_msg">
                        {{ $errors->first('agent_id') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card" id="agent_id_user">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <img class="p-3" src="{{ asset('images/admin/user-not-found.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6 user-id">
                {!! Form::label('user_id', 'User Name', ['class' => 'form-label']) !!}
                <select name="user_id" id="user_id" class="form-select" onchange="userFormatState('user_id')" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <div class="error_msg">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card" id="user_id_user">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <img class="p-3" src="{{ asset('images/admin/user-not-found.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-6">
                {!! Form::label('departure', 'Departure', ['class' => 'form-label']) !!}
                <select name="departure" id="departure" class="form-select">
                    <option selected disabled value="">Choose...</option>
                    @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('departure'))
                    <div class="error_msg">
                        {{ $errors->first('departure') }}
                    </div>
                @endif
            </div>
            <div class="col-6">
                {!! Form::label('destination', 'Destination', ['class' => 'form-label']) !!}
                <select name="destination" id="destination" class="form-select">
                    <option selected disabled value="">Choose...</option>
                    @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('destination'))
                    <div class="error_msg">
                        {{ $errors->first('destination') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('quantity', 'Quantity', ['class' => 'form-label']) !!}
                {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => True]) !!}
                @if($errors->has('quantity'))
                    <div class="error_msg">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('ticket_issue_date', 'Ticket Issue Date', ['class' => 'form-label']) !!}
                {!! Form::text('ticket_issue_date', null, ['class' => 'form-control', 'required' => True]) !!}
                @if($errors->has('ticket_issue_date'))
                    <div class="error_msg">
                        {{ $errors->first('ticket_issue_date') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('travel_date', 'Travel Date', ['class' => 'form-label']) !!}
                {!! Form::text('travel_date', null, ['class' => 'form-control', 'required' => True]) !!}
                @if($errors->has('travel_date'))
                    <div class="error_msg">
                        {{ $errors->first('travel_date') }}
                    </div>
                @endif
            </div>
            <div class="col-6">
                {!! Form::label('corona_test_date', 'Corona Test Date', ['class' => 'form-label']) !!}
                {!! Form::text('corona_test_date', null, ['class' => 'form-control', 'required' => True]) !!}
                @if($errors->has('corona_test_date'))
                    <div class="error_msg">
                        {{ $errors->first('corona_test_date') }}
                    </div>
                @endif
            </div>
            <div class="col-6">
                {!! Form::label('corona_test_result', 'Corona Test Result', ['class' => 'form-label']) !!}
                <select name="corona_test_result" id="corona_test_result" class="form-select" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="positive">positive</option>
                    <option value="negative">negative</option>
                    <option value="not tested">not tested</option>
                </select>
                @if($errors->has('corona_test_result'))
                    <div class="error_msg">
                        {{ $errors->first('corona_test_result') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('price', 'Ticket Price', ['class' => 'form-label']) !!}
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
                @if($errors->has('price'))
                    <div class="error_msg">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('sell_price', 'Ticket Sell Price', ['class' => 'form-label']) !!}
                {!! Form::number('sell_price', null, ['class' => 'form-control']) !!}
                @if($errors->has('sell_price'))
                    <div class="error_msg">
                        {{ $errors->first('sell_price') }}
                    </div>
                @endif
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                {!! Form::label('paid_amount', 'Paid Amount', ['class' => 'form-label']) !!}
                {!! Form::number('paid_amount', null, ['class' => 'form-control']) !!}
                @if($errors->has('paid_amount'))
                    <div class="error_msg">
                        {{ $errors->first('paid_amount') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('payment_type_id', 'Payment Type', ['class' => 'form-label']) !!}
                <select name="payment_type_id" id="payment_type_id" class="form-select">
                    <option selected disabled value="">Choose...</option>
                    @foreach($payment_types as $payment_type)
                        <option value="{{ $payment_type->id }}">{{ $payment_type->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('payment_type_id'))
                    <div class="error_msg">
                        {{ $errors->first('payment_type_id') }}
                    </div>
                @endif
            </div>
            <div class="col-4">
                {!! Form::label('payment_status', 'Payment Status', ['class' => 'form-label']) !!}
                <select name="payment_status" id="payment_status" class="form-select">
                    <option selected disabled value="">Choose...</option>
                    <option value="paid">paid</option>
                    <option value="due">due</option>
                </select>
                @if($errors->has('payment_status'))
                    <div class="error_msg">
                        {{ $errors->first('payment_status') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary mb-5">Save</button>
            </div>
        {!! Form::close() !!}
    </div>
</main>
@endsection

@push('custom-scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var noUser = "{{ asset('images/admin/user.jpeg') }}";
    $(document).ready(function() {
        $('#corona_test_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
        $('#ticket_issue_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
        $('#travel_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
        $('#corona_test_result').select2();
        $('#payment_status').select2();
        $('#payment_type_id').select2();
        $('#departure').select2();
        $('#destination').select2();
        $('#source_id').select2();
        $('#agent_id').select2();
        $('#user_id').select2();
    });
    function userFormatState (state) {
        console.log(state);
        console.log($('#' + state).val());
        var id = $('#' + state).val();

        var url = SITEURL + '/ticket/get/user/' + id;
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function(response) {
                console.log("----------------------->>>>>>>>>>>>>>>>>");
                var htmlData = '';
                htmlData += '<div class="row g-0">';
                htmlData += '<div class="col-md-4">';
                htmlData += '<img src="' + (response.data.image == null ? noUser : response.data.image) + '" class="img-fluid rounded-start" alt="...">';
                htmlData += '</div>';
                htmlData += '<div class="col-md-8">';
                htmlData += '<div class="card-body p-0">';
                htmlData += '<p class="card-text"><small class="text-muted">Name: ' + response.data.name + '</small></p>';
                if(response.data.national_id == null) {
                    htmlData += '<p class="card-text"><small class="text-muted">Pass No: ' + response.data.passport_number + '</small></p>';
                } else {
                    htmlData += '<p class="card-text"><small class="text-muted">Nid: ' + response.data.national_id + '</small></p>';
                }
                htmlData += '<p class="card-text"><small class="text-muted">Phone: ' + response.data.phone + '</small></p>';
                htmlData += '</div>';
                htmlData += '</div>';
                htmlData += '</div>';
                $('#' + state + '_user').html(htmlData);
            }
        });

        // var baseUrl = "/user/pages/images/flags";
        // var $state = $(
        //     '<span><img class="img-flag" /> <span></span></span>'
        // );

        // // Use .text() instead of HTML string concatenation to avoid script injection issues
        // $state.find("span").text(state.text);
        // $state.find("img").attr("src", baseUrl + "/" + state.element.value.toLowerCase() + ".png");
        // return state;
    };
</script>
@endpush
