@extends('installer::layouts.master')

@section('title', trans('installer::installer_messages.welcome.title'))
@section('container')
    <p class="paragraph" style="text-align: center;">{{ trans('installer::installer_messages.welcome.message') }}</p>
    <div class="buttons">
        <a href="{{ route('Installer::environment') }}" class="button">{{ trans('installer::installer_messages.next') }}</a>
    </div>
@stop
