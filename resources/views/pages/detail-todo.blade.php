@extends('layouts.base')
@section('title','جزئیات وظیفه شماره '. $id)
@section('body')
    <x-detail-todo :id="$id"/>
    <div class="mb-3">
        <livewire:CommentTodo :id="$id"/>
    </div>
@endsection
