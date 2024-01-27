@extends('emails.layouts.base')

@section('mail-content')
    <div style="font-family: sans-serif; font-size: 12px; vertical-align: top;white-space: pre-line;">
        <p style="margin: 0;padding: 0;font-size: 12px;">A new contact form was submitted, these are the details:</p>
        <ul style="margin: 0;font-size: 12px;">
            <li style="margin: 0;padding: 0;font-size: 12px;">From name: {{ $recipient_name }}</li>
            <li style="margin: 0;padding: 0;font-size: 12px;">From email: {{ $recipient_email }}</li>
            <li style="margin: 0;padding: 0;font-size: 12px;">Submitted: {{ $date_created }}</li>
            <li style="margin: 0;padding: 0;font-size: 12px;">IP address: {{ $ip_address }}</li>
        </ul>
        <hr style="margin: 0;padding: 0" />
    </div>
    {!! e($the_message) !!}
@endsection
