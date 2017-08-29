@extends('installer::layouts.master')

@section('title', trans('installer::installer_messages.environment.title'))
@section('style')
    <link href="{{ asset('installer/foodsharing-helper/helper.css') }}" rel="stylesheet"/>
    <style>
        .form-control{
            height: 14px;
            width: 100%;
        }
        .has-error{
            color: red;
        }
        .has-error input{
            color: black;
            border:1px solid red;
        }
    </style>
@endsection
@section('container')
    <form method="post" action="{{ route('Installer::environmentSave') }}" id="env-form">
        <div class="form-group">
            <label class="col-sm-2 control-label">MYSQL-Hostname</label>

            <div class="col-sm-10">
                <input type="text" name="hostname" class="form-control"  value="{{ $db_host }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">MYSQL-Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" class="form-control" value="{{ $db_username }}">
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">MYSQL-Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" value="{{ $db_password }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">MYSQL-Database</label>
            <div class="col-sm-10">
                <input type="text" name="database" class="form-control" value="{{ $db_name }}">
            </div>
        </div>
        <div class="modal-footer">
            <div class="buttons">
                <button class="button" onclick="checkEnv();return false">
                    {{ trans('installer::installer_messages.next') }}
                </button>
            </div>
        </div>
    </form>
    <script>
        function checkEnv() {
            $.easyAjax({
                url: "{!! route('Installer::environmentSave') !!}",
                type: "GET",
                data: $("#env-form").serialize(),
                container: "#env-form",
                messagePosition: "inline"
            });
        }
    </script>
@stop
@section('scripts')
    <script src="{{ asset('installer/js/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('installer/foodsharing-helper/helper.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection