@extends('installer::layouts.master')

@section('title', trans('installer::installer_messages.permissions.title'))
@section('container')
    @if (isset($permissions['errors']))
        <div class="alert alert-danger">Please fix the below error and the click  {{ trans('installer::installer_messages.checkPermissionAgain') }}</div>
    @endif
    <ul class="list">
        @foreach($permissions['permissions'] as $permission)
        <li class="list__item list__item--permissions {{ $permission['isSet'] ? 'success' : 'error' }}">
            {{ $permission['folder'] }}<span>{{ $permission['permission'] }}</span>
        </li>
        @endforeach
    </ul>


    <div class="buttons">
        @if ( ! isset($permissions['errors']))
            <a class="button" href="{{ route('Installer::database') }}">
                {{ trans('installer::installer_messages.next') }}
            </a>
        @else
            <a class="button" href="javascript:window.location.href='';">
                {{ trans('installer::installer_messages.checkPermissionAgain') }}
            </a>
        @endif
    </div>

@stop
