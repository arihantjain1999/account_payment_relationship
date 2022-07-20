@component('mail::message')
{!! $maildata['body'] !!}
    @component('mail::button', ['url' => 'https://www.enjayworld.com/'])
        Visit Site
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
