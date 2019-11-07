@component('mail::message')
# Introduction

<h2>Blood Bank Reset Password.</h2>

<p>
    Hello {{$client->name}}
</p>

<!-- @component('mail::button', ['url' => 'http://google.com'])
reset
@endcomponent -->

<p>
    Your Reset Code is: {{$client->pin_code}}
</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
