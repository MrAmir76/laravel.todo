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
        <div class="advanceSearch" x-data id="advanceSearch"
             x-ref="advanceSearch"
             @mousedown.outside="$el.style.display = 'none' ">
            <livewire:Search/>
        </div>
    @else
        <div class="loginRequired"></div>
    @endauth
@endsection
