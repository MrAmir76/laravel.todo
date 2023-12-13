@extends('layouts.base')
@auth()
    @section('title','وظایف من')
@else
    @section('title','خانه')
@endauth
@section('body')
    <x-navbar/>
    @auth()
        <livewire:AddTodo/>
        <livewire:TodoList/>
        <div class="advanceSearch" id="advanceSearch">
            <livewire:Search/>
            @include('include.script.showSearchScript')
        </div>
    @else
        <div class="loginRequired"></div>
    @endauth
@endsection
