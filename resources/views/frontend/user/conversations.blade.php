@extends('frontend.layouts.travelmaker')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
@php
    $login_id =Auth::user()->id;
@endphp

<div class="container-fluid">
    <div class="responsive" style="margin-top: 150px;">
        <h3 style="text-align: center; margin-bottom: 25px; color: #0198cd;">Conversations</h3>
        {{-- <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Phone no.</th>
                <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @if(isset($userdata))
                    @foreach($userdata as $val)
                        <tr class="class-{{$val->user_id}}">
                            <td scope="row">{{$i++}}</td>
                            <td><a href="javascript::void(0)" onclick="getdetails({{$val->user_id}})">{{$val->user['first_name']}} {{$val->user['last_name']}}</a></td>
                            <td>{{$val->phone_no}}</td>
                            <td>{{$val->place_of_residence}}</td>
                        </tr>

                    @endforeach         
                @endif
            </tbody>
        </table> --}}
        @if(Auth::user()->role_type == 'travel_agency')
            <div style="background-color: #DEB887">
                <h3>Collaboration Requests</h3>
                <h4>List Message Recieved</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Phone no.</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Message Recieved</th>
                        <th scope="col">Time Recieved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($listRecieveConversations))
                            @foreach($listRecieveConversations as $val)
                                @if($val->role_type == 'travel_blogger')
                                    <tr>
                                        <td scope="row">{{$i++}}</td>
                                        <td>{{$val->user_name}}</td>
                                        <td>{{$val->phone_number}}</td>
                                        <td>{{$val->email_send}}</td>
                                        <td>{{$val->message}}</td>
                                        <td>{{$val->date_send . '-' . $val->month_send . '-' . $val->year_send}}</td>
                                    </tr>
                                @endif

                            @endforeach         
                        @endif
                    </tbody>
                </table>

                <h4>List Message Sent</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Message Sent</th>
                        <th scope="col">Time Sent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($listSendConversations))
                            @foreach($listSendConversations as $val)
                                @if($val->role_type_recieve == 'travel_blogger')
                                    <tr>
                                        <td scope="row">{{$i++}}</td>
                                        <td>{{$val->email_recieve}}</td>
                                        <td>{{$val->message}}</td>
                                        <td>{{$val->date_send . '-' . $val->month_send . '-' . $val->year_send}}</td>
                                    </tr>
                                @endif

                            @endforeach         
                        @endif
                    </tbody>
                </table>
            </div>
            <div style="background-color: #DCDCDC">
                <h3>Messages Received</h3>
                <h4>List Message Recieved</h4>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Phone no.</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Message Recieved</th>
                        <th scope="col">Time Recieved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @if(isset($listRecieveConversations))
                            @foreach($listRecieveConversations as $val)
                                @if($val->role_type != 'travel_blogger')
                                    <tr>
                                        <td scope="row">{{$i++}}</td>
                                        <td>{{$val->user_name}}</td>
                                        <td>{{$val->phone_number}}</td>
                                        <td>{{$val->email_send}}</td>
                                        <td>{{$val->message}}</td>
                                        <td>{{$val->date_send . '-' . $val->month_send . '-' . $val->year_send}}</td>
                                    </tr>
                                @endif

                            @endforeach         
                        @endif
                    </tbody>
                </table>
            </div>
        @else
            <h4>List Message Recieved</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Phone no.</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Message Recieved</th>
                    <th scope="col">Time Recieved</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @if(isset($listRecieveConversations))
                        @foreach($listRecieveConversations as $val)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{$val->user_name}}</td>
                                <td>{{$val->phone_number}}</td>
                                <td>{{$val->email_send}}</td>
                                <td>{{$val->message}}</td>
                                <td>{{$val->date_send . '-' . $val->month_send . '-' . $val->year_send}}</td>
                            </tr>

                        @endforeach         
                    @endif
                </tbody>
            </table>

            <h4>List Message Sent</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Message Sent</th>
                    <th scope="col">Time Sent</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @if(isset($listSendConversations))
                        @foreach($listSendConversations as $val)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{$val->email_recieve}}</td>
                                <td>{{$val->message}}</td>
                                <td>{{$val->date_send . '-' . $val->month_send . '-' . $val->year_send}}</td>
                            </tr>

                        @endforeach         
                    @endif
                </tbody>
            </table>
        @endif
    </div>    
</div>
<!-- <div class="profile-section mx-50">
  <div class="container-fluid">
    <div class="profile-inner">
      <div class="row">
        <div class="col-md-3">
        
         
            </div>
        </div>
        


    </div>
  </div>
</div>
 -->

<script>
    function getdetails(ids)
    {
        //alert(ids);
        $('.class-user').hide();
        $('.class-'+ids).show();
        $.ajax({
        url: '{{ url("get-conversation") }}',
        type: 'POST',
        data:{
              "_token": "{{ csrf_token() }}",
              "id":ids
              },
        success: function(data) {
            $('.class-user').remove();
           $('.class-'+ids).after(data);
        },
     
    });

    }
    </script>


@endsection
