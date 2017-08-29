@extends('installer::layouts.master')

@section('title', trans('installer::installer_messages.final.title'))
@section('container')
    <p class="paragraph" style="text-align: center;">{{ session('message')['message'] }}</p>
    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer::installer_messages.final.exit') }}</a>
        <a href="{{ url('/install/dummydata') }}" class="button">{{ trans('installer::installer_messages.final.seed') }}</a>
    </div>
@stop
