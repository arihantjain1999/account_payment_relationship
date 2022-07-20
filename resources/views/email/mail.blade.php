@component('mail::message')
<h1 style="text-align: center; color:yellowgreen ; box-shadow: 2px 2px 7px yellowgreen;"> <u> <b> PayLoad  </b></u> </h1>
   You <b> {{ $data['name'] }}  </b> Have Created YOUR ACCOUNT ON our app thanks . <br>
    <hr>
    Welcome {{ $data['name'] }} and have a greate expirience while using 
    <table class="table table-hover">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">1</th>
        </tr>
        <tr>
            <th scope="col">Name</th>
            <th scope="col"> {{ $data['name'] }} </th>
        </tr>
        <tr>
            <th scope="col">Email</th>
            <th scope="col"> {{ $data['email'] }} </th>
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
        </tr>
    </table>
    @component('mail::button', ['url' => 'https://www.enjayworld.com/'])
        Visit Site
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
