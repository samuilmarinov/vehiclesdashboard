<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Webinteractive</title>
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css" crossorigin="anonymous">
       
        <script src="/js/jquery/jquery-latest.js"></script>
        <link rel="stylesheet" href="/css/toastr/toastr.min.css">
        <script src="/js/toastr/toastr.min.js"></script>
    
        <script src="/js/bootstrap/bootstrap-table.min.js"></script>
        <link rel="stylesheet" href="/css/bootstrap/bootstrap-table.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap-table-filter-control.min.css">
        <script src="/js/bootstrap/bootstrap-table-filter-control.js"></script>


        <link rel="stylesheet" href="/css/switchery/switchery.min.css">
        <script src="/js/switchery/switchery.min.js"></script>
        <link href="{{ asset('css/styles.css?v=1.2') }}" rel="stylesheet">
    </head>
    <body>
        @include('nav.nav')

        <div class="flex-top position-ref full-height">
            <div style="padding: 0 50px; text-align: left;" class="content">
           
                    @yield('content')
                 
    
            </div>
        </div>

        <footer style="width:100%;" id="footer" class="footer">
        ©2021
        </footer>
        <script>
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000); 
        </script>
    </body>
</html>