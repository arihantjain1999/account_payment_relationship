@extends('layouts.app')
@section('content')



    <div class="container">
        <table class="table table-hover">
            <thead>

                <tr>
                    <th>id</th>
                    <th>Subject</th>
                    <th>Account Id </th>
                    <th>payment_date</th>
                    <th>payment_pending</th>
                    <th>payment_recived</th>
                    <th>pending_amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedpayments as $deletedpayment)
                <tr>
                    {{-- @dD($deletedpayment->id); --}}
                    <td> {{$deletedpayment->id}} </td>
                    <td> {{$deletedpayment->subject}} </td>
                    <td> {{$deletedpayment->account_id}} </td>
                    <td> {{$deletedpayment->payment_date}} </td>
                    <td> {{$deletedpayment->payment_pending}} </td>
                    <td> {{$deletedpayment->payment_recived}} </td>
                    <td> {{$deletedpayment->pending_amount}} </td>
                    <td><button class="btn btn-warning restore " value="{{$deletedpayment->id}}">Restore</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(function(){
            $(document).on('click' , '.restore' , function(){
                var restore_id  = $(this).val();
                var url = '/restore/'.concat(restore_id);
                console.log(url);
                $.ajax({
                    url :   url , 
                    type: 'GET', 
                    data: {
                        id : restore_id ,
                    },
                    success: function(data){
                        console.log('hello');
                    },
                });
            });
        });
    </script>
@endsection