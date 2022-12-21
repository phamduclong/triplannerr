@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.slider_audio.management'))

@section('breadcrumb-links')
    @include('backend.slider_audio.includes.breadcrumb-links')
@endsection

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="card">
    <div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="card-title mb-0">
						{{ __('labels.backend.access.slider_audio.management') }} <small class="text-muted">{{ __('labels.backend.access.slider_audio.delete') }}</small>
					</h4>
				</div><!--col-->

				<div class="col-sm-7">
					@include('backend.slider_audio.includes.header-buttons')
				</div><!--col-->
			</div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>@lang('labels.backend.access.slider_audio.table.id')</th>
                           <th>@lang('labels.backend.access.slider_audio.table.title')</th>
                           <th>@lang('labels.backend.access.slider_audio.table.audio_name')</th>
                           <th>@lang('labels.backend.access.slider_audio.table.audio')</th>
                           <th>@lang('labels.backend.access.slider_audio.table.status')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                           @foreach($slider_audio as $audio)
                              <tr>
                                <td>{{ $i}}</td>
                                <td>{{ isset( $audio ) ? $audio->title  : '' }}</td>
                                <td>{{ isset( $audio ) ? $audio->slide_audio  : '' }}</td>
                                <td><audio controls src="{{url('audio/backend/',$audio->slide_audio)}}"></audio></td>
                                <td><?php if($audio->status==0){ ?>
                                      <a href="{{ route('admin.slider_audio.status', $audio) }}"><span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.inactive')</span></a>
                                      <?php } 
                                      else{ ?>
                                      <a href="{{ route('admin.slider_audio.status', $audio) }}"><span class="badge badge-success" style="cursor:pointer">@lang('labels.general.active')</span></a>
                                  <?php } ?></td>
                                
                                <td class="btn-td"> <a href="{{ route('admin.slider_audio.restore',$audio) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.slider_audio.restore_user')"  data-trans-title="@lang('buttons.backend.access.slider_audio.are_you_sure_you_want_to_do_this')" data-trans-button-cancel="@lang('buttons.backend.access.slider_audio.cancel')" data-trans-button-confirm="@lang('buttons.backend.access.slider_audio.confirm')">
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
                     {{ $slider_audio->total() }} Record Found
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                   {{ $slider_audio->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@endsection
