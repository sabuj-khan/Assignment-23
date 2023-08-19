@extends('layouts.sidenav-app')
@section('content')
    @include('components.income.income-list')
    @include('components.income.income-create')
    @include('components.income.income-update')
    @include('components.income.income-delete')
@endsection