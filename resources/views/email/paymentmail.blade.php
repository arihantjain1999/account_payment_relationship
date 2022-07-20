@component('mail::message')
{{-- @dd($data) --}}
   You <b> {{ $data['Payment_subject'] }}  </b> Have Created YOUR ACCOUNT ON our app thanks . <br>
    <hr>
    Welcome {{ $data['Payment_subject'] }} and have a greate expirience while using 
    <table class="table table-hover">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">1</th>
        </tr>
        <tr>
            <th scope="col">Payment_subject</th>
            <th scope="col"> {{ $data['Payment_subject'] }} </th>
        </tr>
        <tr>
            <th scope="col">Payment Date</th>
            <th scope="col"> {{ $data['payment_date'] }} </th>
        </tr>
        <tr>
            <th scope="col">Phone</th>
            <th scope="col"> {{ $data['phone'] }} </th>
        </tr>
        <tr>
            <th scope="col">Payment Pending</th>
            <th scope="col">₹ {{ $data['payment_pending'] }}  </th>
        </tr>
        <tr>
            <th scope="col">Status</th>
            <th scope="col"> {{ $data['status'] }} </th>
        </tr>
        <tr>
            <th scope="col">Payment Recived</th>
            <th scope="col">₹ {{ $data['payment_recived'] }} </th>
        </tr><tr>
            <th scope="col">All payment pending</th>
            <th scope="col">₹ {{ $data['all_payment_pending'] }} </th>
        </tr><tr>
            <th scope="col">Payment Recived</th>
            <th scope="col">₹ {{ $data['all_payment_recived'] }} </th>
        </tr>
    </table>
    @component('mail::button', ['url' => 'https://www.enjayworld.com/'])
        Visit Site
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
