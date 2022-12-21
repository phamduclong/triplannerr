@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.staticpage.staticpages'))

@section('breadcrumb-links')
    @include('backend.staticpage.includes.breadcrumb-links')
@endsection

@section('content')

<div class="card">
 <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.staticpage.staticpages') }} <small class="text-muted">{{ __('labels.backend.access.staticpage.active') }}</small>
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    @include('backend.staticpage.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
              <div class="col">
                <div class="table-responsive">
                         <table class="table">
                         <thead>
                           <th>@lang('labels.backend.access.staticpage.table.sno')</th>
                             <th>@lang('labels.backend.access.staticpage.table.name')</th>

                             <th>@lang('labels.backend.access.staticpage.table.description')</th>
                             <th>@lang('labels.backend.access.staticpage.table.slug')</th>
                             <th>@lang('labels.backend.access.staticpage.table.meta_title')</th>
                             <th>@lang('labels.backend.access.staticpage.table.meta_description')</th>
                             <th>@lang('labels.backend.access.staticpage.table.meta_keyword')</th>
                             <th>@lang('labels.general.actions')</th>
                         </thead>
                         <tbody>
                            @php $sno=1 @endphp
                           @foreach($static_page as $page_row)
                            <tr>
                             <td>{{ $sno++ }}</td>
                             <td>{{ $page_row->name }}</td>
                             <td>{{ strip_tags($page_row->description) }}</td>
                             <td><span class="badge badge-success">{{ $page_row->slug }}</span></td>
                             <td>{{ $page_row->meta_title }}</td>
                             <td>{{ $page_row->meta_description }}</td>
                             <td>{{ $page_row->meta_keywords }}</td>
                             <td class="btn-td">@include('backend.staticpage.includes.actions', ['user' => $page_row])</td>
                             
                         </tr>
                         @endforeach
                         </tbody>
                     </table>
                </div>
                </div>
                </div>

                  <div class="row">
            <div class="col-7">
                <div class="float-left">
                   
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{$static_page->render()}} 
                </div>
            </div><!--col-->
        </div><!--row-->
            </div>


        </div>
    </div>
@endsection
