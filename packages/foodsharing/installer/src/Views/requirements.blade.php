@extends('installer::layouts.master')

@section('title', trans('installer::installer_messages.requirements.title'))
@section('container')
    <ul class="list">
        @foreach($requirements['requirements'] as $extention => $enabled)
        <li class="list__item {{ $enabled ? 'success' : 'error' }}">{{ $extention }}</li>
        @endforeach
    </ul>

    @if ( ! isset($requirements['errors']))
        <div class="buttons">
            <a class="button" href="{{ route('Installer::permissions') }}">
                {{ trans('installer::installer_messages.next') }}
            </a>
        </div>
    @endif
@stop
