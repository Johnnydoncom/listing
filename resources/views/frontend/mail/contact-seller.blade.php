<p>@lang('strings.emails.contact.email_body_title')</p>

<p><strong>Name:</strong> {{ $request->name }}</p>
<p><strong>Email:</strong> {{ $request->email }}</p>
<p><strong>Phone No:</strong> {{ $request->phone or "N/A" }}</p>
<p><strong>Message:</strong> {{ $request->message }}</p>
