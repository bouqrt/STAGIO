@extends('layouts.app')

@if(auth()->user()->role === 'admin')
    @section('title', 'Admin Dashboard')
    @section('subtitle', 'See the main statistics of the website.')
@elseif(auth()->user()->role === 'entreprise')
    @section('title', 'Entreprise Dashboard')
    @section('subtitle', 'See your offers and recent applications.')
@else
    @section('title', 'Student Dashboard')
    @section('subtitle', 'See offers and your applications.')
@endif

@section('content')
    @if(auth()->user()->role === 'admin')
        @include('admin.partials.dashboard-content')
    @elseif(auth()->user()->role === 'entreprise')
        @include('entreprise.partials.dashboard-content')
    @else
        @include('student.partials.dashboard-content')
    @endif
@endsection
