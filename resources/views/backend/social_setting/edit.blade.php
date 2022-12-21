@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.staticpage.edit-page'))

@section('breadcrumb-links')
    @include('backend.staticpage.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.staticpage.update', $static_page_edit->id))->class('form-horizontal')->open() }}
<div class="card">


<div class="card-body">
  <div class="row">
    <div class="col-sm-5">
        <h4 class="card-title mb-0">
            @lang('labels.backend.access.staticpage.staticpages')
            <small class="text-muted"> @lang('labels.backend.access.staticpage.edit-page')</small>
        </h4>
    </div><!--col-->
</div><!--row-->
<div class="row mt-4 mb-4">
<div class="col">


<div class="form-group row">
{{ html()->label(__('validation.attributes.backend.access.static-page.page-name'))->class('col-md-2 form-control-label')->for('name') }}

    <div class="col-md-10">
        {{ html()->text('name')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.static-page.page-name'))
            ->attribute('maxlength', 191)
            ->attribute('value', $static_page_edit->name)
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div><!--form-group-->


<div class="form-group row">
{{ html()->label(__('validation.attributes.backend.access.static-page.page-url'))->class('col-md-2 form-control-label')->for('page-url') }}

<div class="col-md-10">
    {{ html()->text('page_url')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.static-page.page-url'))
        ->attribute('maxlength', 191)
         ->attribute('value', $static_page_edit->url)
            ->required()
        ->required() }}
</div><!--col-->
</div><!--form-group-->


<div class="form-group row">
{{ html()->label(__('validation.attributes.backend.access.static-page.page-description'))->class('col-md-2 form-control-label')->for('page-description') }}

<div class="col-md-10">
    {{-- html()->textarea('page_description')
        ->class('form-control')
        ->placeholder(__('validation.attributes.backend.access.static-page.page-description'))
        ->attribute('maxlength', 191)
         ->attribute('value', $static_page_edit->description)
            ->required()
        ->required() --}}
<textarea class="form-control" name="page_description" placeholder="{{ __('validation.attributes.backend.access.static-page.page-description') }}" maxlength="191" required>{!! _($static_page_edit->description) !!}</textarea>
</div><!--col-->
</div><!--form-group-->


<div class="form-group row">
{{ html()->label(__('validation.attributes.backend.access.static-page.meta-title'))->class('col-md-2 form-control-label')->for('meta-title') }}

    <div class="col-md-10">
        {{ html()->text('meta_title')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.static-page.meta-title'))
            ->attribute('maxlength', 191)
             ->attribute('value', $static_page_edit->meta_title)
            ->required()
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
{{ html()->label(__('validation.attributes.backend.access.static-page.meta-description'))->class('col-md-2 form-control-label')->for('meta-description') }}

    <div class="col-md-10">
        {{ html()->text('meta_description')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.static-page.meta-description'))
            ->attribute('maxlength', 191)
             ->attribute('value', $static_page_edit->meta_description)
            ->required()
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div><!--form-group-->


<div class="form-group row">
{{ html()->label(__('validation.attributes.backend.access.static-page.meta-keyword'))->class('col-md-2 form-control-label')->for('meta-keyword') }}

    <div class="col-md-10">
        {{ html()->text('meta_keyword')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.access.static-page.meta-keyword'))
            ->attribute('maxlength', 191)
             ->attribute('value', $static_page_edit->meta_keywords)
            ->required()
            ->required()
            ->autofocus() }}
    </div><!--col-->
</div><!--form-group-->

</div>
</div>
</div>

<div class="card-footer clearfix">
<div class="row">
<div class="col">
    {{ form_cancel(route('admin.staticpage'), __('buttons.general.cancel')) }}
</div><!--col-->

<div class="col text-right">
    {{ form_submit(__('buttons.general.crud.update')) }}
</div><!--col-->
</div><!--row-->
</div><!--card-footer-->

</div>
{{ html()->form()->close() }}



@endsection
