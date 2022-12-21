@if (count($travelPar->participates))
@foreach($travelPar->participates as $participate)
<tr style="font-size: 13px">
<th scope="row" style="font-size: 13px">{{ $participate->travel_report_name }}</th>
<td style="font-size: 13px">{{ Carbon\Carbon::parse($participate->date_click)->format('d/m/Y') }}</td>
<td style="font-size: 13px"><a href="{{ $participate->link_profile }}" style="color: #007bff">{{ $participate->user_name }}</a></td>
<td style="font-size: 13px">{{ $participate->user_email }}</td>
</tr>
@endforeach
@endif
  