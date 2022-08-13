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
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">


    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- button export plugin css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    {{-- filtre avancer plugin css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.3.4/css/searchBuilder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">

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
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>

    {{-- button export plugin js --}}
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    {{-- button print plugin js --}}
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
        // chart script
        function generateData(e, t, o) {
    for (var a = 0, r = []; a < t; ) {
        var s = Math.floor(750 * Math.random()) + 1,
            i = Math.floor(Math.random() * (o.max - o.min + 1)) + o.min,
            l = Math.floor(61 * Math.random()) + 15;
        r.push([s, i, l]), a++;
    }
    return r;
}
var columnChart,
    columnChartoptions = {
        series: [
            {
                name: "Arriver",
                data: [
                    32, 66, 44, 55, 41, 24, 67, 22, 43, 32, 66, 44, 55, 41, 24,
                    67, 22, 43,
                ],
            },
            {
                name: "Depart",
                data: [
                    7, 30, 13, 23, 20, 12, 8, 13, 27, 7, 30, 13, 23, 20, 12, 8,
                    13, 27,
                ],
            },
        ],
        chart: {
            type: "bar",
            height: 350,
            stacked: !1,
            columnWidth: "70%",
            zoom: { enabled: !0 },
            toolbar: { show: !1 },
            background: "transparent",
        },
        dataLabels: { enabled: !1 },
        theme: { mode: colors.chartTheme },
        responsive: [
            {
                breakpoint: 480,
                options: {
                    legend: { position: "bottom", offsetX: -10, offsetY: 0 },
                },
            },
        ],
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "40%",
                radius: 30,
                enableShades: !1,
                endingShape: "rounded",
            },
        },
        xaxis: {
            type: "datetime",
            categories: [
                "01/01/2020 GMT",
                "01/02/2020 GMT",
                "01/03/2020 GMT",
                "01/04/2020 GMT",
                "01/05/2020 GMT",
                "01/06/2020 GMT",
                "01/07/2020 GMT",
                "01/08/2020 GMT",
                "01/09/2020 GMT",
                "01/10/2020 GMT",
                "01/11/2020 GMT",
                "01/12/2020 GMT",
                "01/13/2020 GMT",
                "01/14/2020 GMT",
                "01/15/2020 GMT",
                "01/16/2020 GMT",
                "01/17/2020 GMT",
                "01/18/2020 GMT",
            ],
            labels: {
                show: !0,
                trim: !0,
                minHeight: void 0,
                maxHeight: 120,
                style: {
                    colors: colors.mutedColor,
                    cssClass: "text-muted",
                    fontFamily: base.defaultFontFamily,
                },
            },
            axisBorder: { show: !1 },
        },
        yaxis: {
            labels: {
                show: !0,
                trim: !1,
                offsetX: -10,
                minHeight: void 0,
                maxHeight: 120,
                style: {
                    colors: colors.mutedColor,
                    cssClass: "text-muted",
                    fontFamily: base.defaultFontFamily,
                },
            },
        },
        legend: {
            position: "top",
            fontFamily: base.defaultFontFamily,
            fontWeight: 400,
            labels: { colors: colors.mutedColor, useSeriesColors: !1 },
            markers: {
                width: 10,
                height: 10,
                strokeWidth: 0,
                strokeColor: "#fff",
                fillColors: [extend.successColor, extend.successColorLighter],
                radius: 6,
                customHTML: void 0,
                onClick: void 0,
                offsetX: 0,
                offsetY: 0,
            },
            itemMargin: { horizontal: 10, vertical: 0 },
            onItemClick: { toggleDataSeries: !0 },
            onItemHover: { highlightDataSeries: !0 },
        },
        fill: {
            opacity: 1,
            colors: [base.successColor, extend.primaryColorLighter],
        },
        grid: {
            show: !0,
            borderColor: colors.borderColor,
            strokeDashArray: 0,
            position: "back",
            xaxis: { lines: { show: !1 } },
            yaxis: { lines: { show: !0 } },
            row: { colors: void 0, opacity: 0.5 },
            column: { colors: void 0, opacity: 0.5 },
            padding: { top: 0, right: 0, bottom: 0, left: 0 },
        },
    },
    columnChartCtn = document.querySelector("#columnChart");
columnChartCtn &&
    (columnChart = new ApexCharts(columnChartCtn, columnChartoptions)).render();

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
    @livewireScripts
</body>

</html>
