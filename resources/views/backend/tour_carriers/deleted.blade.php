@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.tour_carriers.management'))

@section('breadcrumb-links')
    @include('backend.tour_carriers.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.tour_carriers.management') }} <small class="text-muted">{{ __('labels.backend.access.tour_carriers.active') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.tour_carriers.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.tour_carriers.table.id')</th>
                            <th>@lang('labels.backend.access.tour_carriers.table.title')</th>
                          <!--   <th>@lang('labels.backend.access.tour_carriers.table.description')</th> -->
                            <th>@lang('labels.backend.access.tour_carriers.table.graphic_type')</th>
                             <th>@lang('labels.backend.access.tour_carriers.table.graphic_content')</th>
                            <th>@lang('labels.backend.access.tour_carriers.table.last_updated')</th>
                            <th>@lang('labels.backend.access.tour_carriers.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($tour_carriers as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->title }}</td>
                               
                                <td>{{ $user->graphic_type }}</td>
                                    @if($user->graphic_type == 'image')
                                    <td><img src="{{ url('/img/backend/tour_carriers/'.$user->graphic_type) .'/'.$user->graphic_content }}" / width="50px" height="50px"></td>
                                    @else
                                    <td><i class="{{$user->graphic_content}}" aria-hidden="true" style="font-size: 50px;"></i></td>
                                    
                                    @endif
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td><?php if($user->status==0){ ?>
                                      <a href="{{ route('admin.tour_carriers.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                      <?php } 
                                      else{ ?>
                                      <a href="{{ route('admin.tour_carriers.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td"> <a href="{{ route('admin.tour_carriers.restore',$user) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.tour_carriers.restore_user')"  data-trans-title="@lang('buttons.backend.access.tour_carriers.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.tour_carriers.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.tour_carriers.confirm')">
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
                
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
