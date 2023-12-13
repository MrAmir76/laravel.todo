@extends('layouts.base')
@section('title','جستوجوی نتایج')
@section('body')
    <x-navbar/>
    @include('livewire.todo-list')
    <div class="advanceSearch" id="advanceSearch">
        <livewire:Search/>
        @include('include.script.showSearchScript')
    </div>
@endsection
