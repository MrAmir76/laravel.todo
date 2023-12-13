@extends('layouts.base')
@section('title','جزئیات وظیفه شماره '. $id)
@section('body')
    <x-detail-todo :id="$id"/>
    <x-comment-todo :id="$id"/>
@endsection
