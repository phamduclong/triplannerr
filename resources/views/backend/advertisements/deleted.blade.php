@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.advertisements.management'))

@section('breadcrumb-links')
    @include('backend.advertisements.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.advertisements.management') }} <small class="text-muted">{{ __('labels.backend.access.advertisements.deleted') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-2">
                    @include('backend.advertisements.includes.header-buttons')
                </div><!--col-->
                <!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.advertisements.table.id')</th>
                            <th>@lang('labels.backend.access.advertisements.table.title')</th>
                            <th>@lang('labels.backend.access.advertisements.table.ad_type')</th>
                            <th>@lang('labels.backend.access.advertisements.table.view')</th>
                            <th>@lang('labels.backend.access.advertisements.table.location')</th>
                            <th>@lang('labels.backend.access.advertisements.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($advertisement as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>
                                  <a href="{{ route('admin.advertisements.show', $user) }}" >
                                    {{ $user->title }}
                                </a>
                                </td>
                                <td>
                                   @if($user->type=='image')
                                     @if(!empty($user->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$user->type_file)) )
                                      <img src="{{url('img/backend/advertisement/'.$user->type_file)}}" style="height: 150px; width: 250px;">
                                      @else
                                      <img src="{{url('img/frontend/inner-banner.jpg')}}" style="height: 100px; width: 100px;">
                                     @endif
                                    @endif
                                    @if($user->type=='video')
                                       @if(!empty($user->type_file) && file_exists(public_path('img/backend/advertisement'.'/'.$user->type_file)) )
                                        <video width="250" controls>
                                          <source src="{{url('img/backend/advertisement/'.$user->type_file)}}" type="video/mp4">
                                        </video>
                                        @endif
                                      <iframe width="250" src=" {{isset($user->embedded_link)?$user->embedded_link:''}}">
                                      </iframe>
                                    @endif
                                </td>
                              
                                <td>{{ $user->view }}</td>
                                <td>{{ $user->location }}</td>
                                <td><?php if($user->status==0){ ?>
                                          <a href="{{ route('admin.advertisements.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.advertisements.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                  <td class="btn-td"> <a href="{{ route('admin.advertisements.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.advertisements.restore_user')"  data-trans-title="@lang('buttons.backend.access.advertisements.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.advertisements.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.advertisements.confirm')">
                                  <i class="fas fa-sync"></i>
                                  </a>
                                  </td>
                            </tr>
                           <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                  {{$advertisement->total()}} Record Found
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   {{$advertisement->render()}} 
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection



