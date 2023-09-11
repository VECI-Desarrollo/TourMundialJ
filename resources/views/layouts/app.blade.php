<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Registro de Pagos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('/img/favicon.ico') }}">
        <link rel="shortcut icon" sizes="192x192" href="{{ asset('/img/favicon.ico') }}">

       <!--- dashboard secction -->

       <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />


   

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />



    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js" defer></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js" defer ></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js" defer ></script>

       <!--- end dashboard section --->



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('js/scripts.js') }}" defer></script>


        @livewireStyles

    </head>
    <body class="font-sans antialiased" >
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:navigation-bar />



            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts


        
    </body>

    <!-- modal roles Info -->
  
    <livewire:modales.user-register>
        <livewire:modales.roles-info >   

    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js" defer></script>
    <script src="assets/vendor/libs/popper/popper.js" defer></script>
    <script src="assets/vendor/js/bootstrap.js" defer></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js" defer></script>

    <script src="assets/vendor/libs/hammer/hammer.js" defer></script>


    <script src="assets/vendor/libs/i18n/i18n.js" defer></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js" defer></script>

    <script src="assets/vendor/js/menu.js" defer></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js" defer></script>

    <!-- Main JS -->
    <script src="assets/js/main.js" defer></script>

    <!-- Page JS -->
    
        <script src="assets/js/dashboards-analytics.js" defer></script>

  
  

    

</html>
