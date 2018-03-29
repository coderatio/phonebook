<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phonebook app</title>
    <link rel="stylesheet" href="{{ url('node_modules/font-awesome/css/font-awesome.min.css') }}">
    {{--<link rel="stylesheet" href="{{ url('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('vendors/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <Appheader></Appheader>
        <div class="container">
            <router-view></router-view>
        </div>
        <Appfooter></Appfooter>
    </div>

    <script src="{{ url('node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script>
        function toast(message, classess = 'toast-rounded') {
            return M.toast({html: `<i class="material-icons circle green left" style="padding: 5px;">done</i> ${message}`, classes: classess});
        }

        function errorToast(message, classess = 'toast-rounded error') {
            return M.toast({html: `<i class="material-icons circle orange left" style="padding: 5px;">error</i> ${message}`, classes: classess});
        }
        const appItemsPerPage = '{{ settings('per_page') }}';

    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>