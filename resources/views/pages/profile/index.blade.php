@extends('layouts.app')
@section('body')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('pages.profile.include.update-profile-information-form')
            <div class="p-4 sm:p-8  dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.profile.include.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
