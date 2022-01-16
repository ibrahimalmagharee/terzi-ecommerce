@component('mail::message')
    <h2>Hello Admin</h2>
    You received an email
    Here are the details:
    <br>
    <b>Email:</b> {{$data['email']}} <br>
    <b>Phone Number:</b> {{$data['phone_number']}} <br>
    <b>Address Request:</b> {{$data['address_request']}} <br>
    <b>Message:</b> {{$data['message']}} <br>
    Thank You

@component('mail::button', ['url' => 'mailto'.$data['email']])
Replay to {{$data['email']}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
