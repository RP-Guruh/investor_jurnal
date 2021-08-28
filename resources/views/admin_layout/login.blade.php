@extends('../layout/base')

@section('body')
    <body class="login overflow-x-hidden">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection