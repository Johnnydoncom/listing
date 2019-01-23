@component('mail::message')
# Post Approved

Your post have been approved and is now visible to public.

@component('mail::button', ['url' => $url])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
