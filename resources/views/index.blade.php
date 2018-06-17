@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="{{ asset('css/accounts.css') }}" rel="stylesheet">
@endpush

@section('content')

<section ng-app="indexApp" class="" ng-view></section>
@endsection

@push('styles')
<script type="text/javascript" src="{{ asset('/bower_components/angular/angular.js')}}"></script>
<script type="text/javascript" src="{{ asset('/bower_components/angular-route/angular-route.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/index.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/controllers/filesCtrl.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/controllers/homeCtrl.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/controllers/accountsCtrl.js')}}"></script>
@endpush
