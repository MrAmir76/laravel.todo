@extends('layouts.base')
@section('title','جستوجوی نتایج')
@section('body')
    <x-navbar/>
    @include('livewire.todo-list')
    <div class="advanceSearch" x-data id="advanceSearch"
         x-ref="advanceSearch" @mousedown.outside="$el.style.display = 'none' ">
        <livewire:Search/>
    </div>
@endsection