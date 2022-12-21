{{-- <p>@lang('strings.emails.contact.email_body_title')</p> --}}

{{-- <p><strong>@lang('validation.attributes.frontend.name'):</strong> {{ $name }}</p> --}}
<div>
    A user registered on Triplannerr has requested information regarding your invitation to travel together. Contact him directly to organize your trip!
</div>
<p><strong>@lang('validation.attributes.frontend.name'):</strong> {{ $last_name . $first_name }}</p>
<p><strong>Link to triplannerr profile:</strong> {{ $profile_link }}</p>
<p><strong>@lang('validation.attributes.frontend.email'):</strong> {{ $email }}</p>
<p><strong>Link to travel buddy search:</strong>{{ $travel_report_link }}</p>

{{-- <p><strong>{{ $name }} </strong> {{$content}}</p> --}}
