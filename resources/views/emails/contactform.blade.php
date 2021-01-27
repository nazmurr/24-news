@component('mail::message')

Name: {{ $name }}  
Email: {{ $email }}  
Subject: {{ $subject }}  
Message: {{ $message }}  

Thanks,<br>
{{ config('app.name') }}
@endcomponent
