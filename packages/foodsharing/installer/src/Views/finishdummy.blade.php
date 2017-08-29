@extends('installer::layouts.master')

@section('title', trans('installer::installer_messages.final.exit'))
@section('container')
    <p class="paragraph" style="text-align: center;">{{ trans('installer::installer_messages.final.dummyhead') }}</p>

    <table>
        <thead>
            <th>E-Mail</th>
            <th>Passwort</th>
        </thead>
        <tbody>
    @foreach($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>password</td>
            </tr>
    @endforeach
        </tbody>
    </table>
    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer::installer_messages.final.exit') }}</a>
    </div>
@stop
