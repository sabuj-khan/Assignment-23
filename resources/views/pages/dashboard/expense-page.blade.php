@extends('layouts.sidenav-app')
@section('content')
   @include('components.expense.expense-list')
   @include('components.expense.expense-create')
   @include('components.expense.expense-update')
   @include('components.expense.expense-delete')
@endsection