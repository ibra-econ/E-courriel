  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>Dashboard</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">


    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/progress.css') }}">
    {{-- button export plugin css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    {{-- button export and print style --}}
    <style>
        button.dt-button,
        div.dt-button,
        a.dt-button,
        input.dt-button {
            color: #fff;
            background: #00704D;
        }
    </style>
     @if (Auth::user()->role !== "admin" || "superuser")
     <style>
         div.dt-buttons {
             display: none;
         }
     </style>
     @endif
</head>

<body class="vertical  light  ">
    <div class="wrapper" id="app">
        @include('layouts.nav')
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        {{-- contenu --}}
                        @yield('content')
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
        </main> <!-- main -->
    </div> <!-- .wrapper -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
    <script src='{{ asset('js/daterangepicker.js') }}'></script>
    <script src='{{ asset('js/jquery.stickOnScroll.js') }}'></script>
    <script src="{{ asset('js/tinycolor-min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/d3.min.js') }}"></script>
    <script src="{{ asset('js/topojson.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/apps.js') }}"></script>

    <script src='{{ asset('js/select2.min.js') }}'></script>
    <script src='{{ asset('js/jquery.steps.min.js') }}'></script>
    <script src='{{ asset('js/jquery.validate.min.js') }}'></script>
    <script src='{{ asset('js/quill.min.js') }}'></script>
    <script src="{{ asset('js/topojson.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.custom.js') }}"></script>
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>

    {{-- button export plugin js --}}
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    {{-- button print plugin js --}}
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    @yield('chart')
    <script>

    // data table parametre
        $('#dataTable-1').DataTable(
        {
          autoWidth: true,
          autoFill: true,
          responsive: true,
        //   scrollX: true,
        @yield('scroll')
          'order':[[0,'desc']],
          "lengthMenu": [
            [16, 32, 64, -1],
            [16, 32, 64, "All"]
          ],
          dom: 'Bfrtip',
            buttons: [
                'print',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
            ],
        });
        $('.select2').select2(
      {
        theme: 'bootstrap4',
      });

      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
              (function()
          {
            'use strict';
            window.addEventListener('load', function()
            {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form)
              {
                form.addEventListener('submit', function(event)
                {
                  if (form.checkValidity() === false)
                  {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
    </script>
</body>
</html>
