@component('mail::message')
# Post Disapproved!

Your post have been disabled for some reasons. Kindly contact Admin for help.

@component('mail::button', ['url' => $url])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
