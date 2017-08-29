<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('installer::installer_messages.title') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-16x16.png') }}" sizes="16x16"/>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-96x96.png') }}" sizes="96x96"/>


    <link href="{{ asset('installer/css/style.min.css') }}" rel="stylesheet"/>
    @yield('style')

</head>
<body>
<div class="master">
    <div class="box">
        <div class="header">
            <img src="{{ asset('/logo/knap.png') }}" height="40px" alt="">
            <h1 class="header__title">@yield('title')</h1>
        </div>
        <ul class="step">
            <li class="step__divider"></li>
            <li class="step__item @if (isActive('Installer::final') || isActive('Installer::finaldummy')) active @endif"><i class="step__icon database"></i></li>
            <li class="step__divider"></li>
            <li class="step__item {{ isActive('Installer::permissions') }}"><i class="step__icon permissions"></i></li>
            <li class="step__divider"></li>
            <li class="step__item {{ isActive('Installer::requirements') }}"><i class="step__icon requirements"></i></li>
            <li class="step__divider"></li>
            <li class="step__item {{ isActive('Installer::environment') }}"><i class="step__icon update"></i></li>
            <li class="step__divider"></li>
            <li class="step__item {{ isActive('Installer::welcome') }}"><i class="step__icon welcome"></i></li>
            <li class="step__divider"></li>
        </ul>
        <div class="main">
            @yield('container')
        </div>
    </div>
</div>
</body>
@yield('scripts')
</html>
