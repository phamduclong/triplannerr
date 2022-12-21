<p>@lang('strings.emails.contact.email_body_title')</p>

<p><strong>@lang('validation.attributes.frontend.name'):</strong> {{ $name }}</p>
<p><strong>@lang('validation.attributes.frontend.email'):</strong> {{ $email }}</p>
<p><strong>Travel Proposal:</strong> {{ $report_name }}</p>
<p><strong>Travel Proposal Price:</strong> {{ $cost }}</p>
<p><strong>Minimum number of participants in the "Travel Proposal":</strong> {{ $member }}</p>
<!-- <p>The "Travel Maker" will play the role of "Tour Leader" during the trip in the manner described in  --><p>{{$content}}
<a href="{{url('travel_report_proposal',$report_id)}}">Travel Maker</a></p>
