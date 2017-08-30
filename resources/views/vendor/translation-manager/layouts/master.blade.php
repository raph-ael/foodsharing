@extends ('backend.layouts.app')

@section ('title', trans('translation-manager.translation-manager'))

@section('page-header')
    <h1>
        {{ trans('translation-manager.translation-manager') }}
    </h1>
@endsection

@section('after-scripts')
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js"></script>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="<?= $public_prefix ?>translation-manager/js/rails.min.js"></script>
    <script src="<?= $public_prefix ?>translation-manager/js/inflection.js"></script>
    <script src="<?= $public_prefix ?>translation-manager/js/translations.js"></script>
    @yield('body-bottom')
@endsection