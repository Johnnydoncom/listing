@extends('frontend.layouts.app')
@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )
@section('content')
<div class="row d-flex justify-content-center">
    <addlisting-component></addlisting-component>
</div>
    
@endsection
