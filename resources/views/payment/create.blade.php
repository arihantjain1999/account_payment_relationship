@extends('layouts.app')
@section('content')



<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"> <a href=" {{route('payments.index')}} ">Payment Details </a> </li>
          <li class="breadcrumb-item acti ve" aria-current="page">Editing  Payment</li>
          {{-- <li class="breadcrumb-item active" aria-current="page">Subject Data</li>s --}}
        </ol>
      </nav>
      @php
         $ldate = date('Y-m-d H:i:s');
      @endphp
      {{-- @dd(); --}}
      

      {!! Form::open(['method' => 'POST' , 'route' => 'payments.store' , 'class' => 'form-horizontal']) !!}
    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
        {!! Form::label('subject', 'Subject') !!}
        {!! Form::text('subject', $account->name.' '.$ldate, ['class' => 'form-control', 'required' => 'required' , 'readonly']) !!}
        <small class="text-danger">{{ $errors->first('subject') }}</small>
    </div>
    <div class="form-group{{ $errors->has('account_id') ? ' has-error' : '' }}">
        {!! Form::label('account_id', 'Account ID') !!}
        {!! Form::text('account_id', $account->id, ['class' => 'form-control', 'required' => 'required', 'readonly']) !!}
        <small class="text-danger">{{ $errors->first('account_id') }}</small>
    </div>

    <div class="form-group{{ $errors->has('payment_date') ? ' has-error' : '' }}">
        {!! Form::label('payment_date', 'Payment Date') !!}
        {!! Form::text('payment_date', null, ['class' => 'form-control datetimepicker', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('payment_date') }}</small>
    </div>
    <div class="form-group{{ $errors->has('payment_pending') ? ' has-error' : '' }}">
        {!! Form::label('payment_pending', 'PaymentPending') !!}
        {!! Form::number('payment_pending', 0, ['class' => 'form-control', 'required' => 'required' , ]) !!}
        <small class="text-danger">{{ $errors->first('payment_pending') }}</small>
    </div>
    <div class="form-group{{ $errors->has('payment_recived') ? ' has-error' : '' }}">
        {!! Form::label('payment_recived', 'Payment Recived') !!}
        {!! Form::number('payment_recived', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('payment_recived') }}</small>
    </div>
    <div class="form-group{{ $errors->has('pending_amount') ? ' has-error' : '' }}">
        {!! Form::label('pending_amount', 'Pending Amount') !!}
        {!! Form::number('pending_amount', $account->payment_pending, ['class' => 'form-control', 'required' => 'required' , 'readonly']) !!}
        <small class="text-danger">{{ $errors->first('pending_amount') }}</small>
    </div>
    <div class="btn-group pull-right my-3">
        {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
        {!! Form::submit('Add', ['class' => 'btn btn-Add']) !!}
    </div>
    {!! Form::close() !!}
</div>

<script>
    $(function() {
        $('input[name="payment_date"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            timePicker: true,
            locale: {
                format: 'M/DD/YYYY hh:mm A'
            },
            maxYear: parseInt(moment().format('YYYY'), 10)
        });

        $(document).on('keydown' , 'input[name="payment_recived"]' , function(){
            // console.log($(this).val());
            var payment_recived = $(this).val();
            var pending_amount = $('input[name="payment_pending"]').val() - payment_recived;
            $('input[name="pending_amount"]').val(pending_amount);
            
        });

    
    })
</script>


@endsection