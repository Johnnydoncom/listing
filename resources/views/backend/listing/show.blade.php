@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Update Listing'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

<editlisting-component :slisting=" {{ $listing }}"></editlisting-component>

@endsection
