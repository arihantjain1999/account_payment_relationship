@extends('layouts.app')
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"> <a href=" {{route('accounts.index')}} ">Account Details </a> </li>
              <li class="breadcrumb-item acti ve" aria-current="page">Creating Account</li>
              {{-- <li class="breadcrumb-item active" aria-current="page">Subject Data</li>s --}}
            </ol>
          </nav>
    
        {!! Form::open(['method' => 'POST', 'route' => 'accounts.store', 'class' => 'form-horizontal']) !!}
        <div class="row">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::label('name', 'Name') !!}
                    </div>
                    <div class="col-md-9">
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::label('email', 'Email address') !!}
                    </div>
                    <div class="col-md-9">
                        {!! Form::email('email', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'eg: foo@bar.com',
                        ]) !!}
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }} m-1">
                <div class="row">
                    <div class="col-md-2">
                        {!! Form::label('address', 'Address') !!}
                    </div>
                    <div class="col-md-10">
                        {!! Form::textarea('address', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '3']) !!}
                        <small class="text-danger">{{ $errors->first('address') }}</small>
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::number('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('phone') }}</small>
            </div>

            <div class="form-group{{ $errors->has('payment_pending') ? ' has-error' : '' }}">
                {!! Form::label('payment_pending', 'Payment Pending') !!}
                {!! Form::number('payment_pending', 0, ['class' => 'form-control', 'required' => 'required' ,'readonly']) !!}
                <small class="text-danger">{{ $errors->first('payment_pending') }}</small>
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', 'Status') !!}
                {!! Form::text('status', 'unpaid', ['class' => 'form-control', 'required' => 'required', 'readonly' ,'readonly']) !!}
                <small class="text-danger">{{ $errors->first('status') }}</small>
            </div>
            <div class="form-group{{ $errors->has('payment_recived') ? ' has-error' : '' }}">
                {!! Form::label('payment_recived', 'Payment Recived') !!}
                {!! Form::number('payment_recived', 0, ['class' => 'form-control', 'required' => 'required' , 'readonly']) !!}
                <small class="text-danger">{{ $errors->first('payment_recived') }}</small>
            </div>
        </div>
        <div class="btn-group pull-right">
            {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection
