@extends('frontend.layouts.master')

@section('title', isset($settings) ? $settings->site_name : '')

@section('content')

@if(isset($pageSections) && count($pageSections) > 0)
    @foreach($pageSections as $pageSection)
        <x-dynamic-section :pageSection="$pageSection" />
    @endforeach
@endif
@endsection