@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.feedback.management'))

@section('breadcrumb-links')
    @include('backend.feedback.includes.breadcrumb-links')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.feedback.management') }} <small class="text-muted">{{ __('labels.backend.access.feedback.deactivated') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.feedback.includes.header-buttons')
                </div><!--col-->
                <!--col-->
            </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.feedback.table.id')</th>
                            <th>@lang('labels.backend.access.feedback.table.feedback_type')</th>
                            <th>@lang('labels.backend.access.feedback.table.content')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type1')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type2')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type3')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type4')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type5')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type6')</th>
                            <th>@lang('labels.backend.access.feedback.table.rating_type7')</th>
                             <th>@lang('labels.backend.access.feedback.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($feedback as $user)
                            <tr>
                                <td>{{ $i}}</td>
                                <td>{{ $user->feedback_type }}</td>
                                <td>{{ $user->content }}</td>
                                <td>{{ $user->rating_type1 }}</td>
                                <td>{{ $user->rating_type2 }}</td>
                                <td>{{ $user->rating_type3 }}</td>
                                <td>{{ $user->rating_type4 }}</td>
                                <td>{{ $user->rating_type5 }}</td>
                                <td>{{ $user->rating_type6 }}</td>
                                <td>{{ $user->rating_type7 }}</td>
                                <td><?php if($user->status==0){ ?>
                                          <a href="{{ route('admin.feedback.status', $user) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                          <?php } 
                                          else{ ?>
                                          <a href="{{ route('admin.feedback.status', $user) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                      <?php } ?></td>
                                <td class="btn-td">@include('backend.feedback.includes.actions', ['user' => $user])</td>
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
