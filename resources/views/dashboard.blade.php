@extends('layouts.app')
@section('content')
{{-- star statisitique --}}
<div class="row">

    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <a class="nav-link" href="{{ route('Depart') }}">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-trending-up text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Départ</p>
                            <span class="mb-0 text-white h3">{{ $depart }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-2">
            <div class="card-body">
                <a href="{{ route('Arriver') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-trending-down text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Arrivées</p>
                            <span class="mb-0 text-white h3">{{ $arriver }}</span>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-3">
            <div class="card-body">
                <a href="{{ route('Arriver') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-bell text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total Notification</p>
                            <span class="mb-0 text-white h3">{{ $notification->notifications_count }}</span>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div> <!-- end section -->

{{-- si user admin --}}
@if (Auth::user()->role === "admin")
<div class="row">
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green">
            <div class="card-body">
                <a href="{{ route('Correspondant') }}" class="nav-link">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-user-check fe-trending-up text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Correspondant</p>
                        <span class="mb-0 text-white h3">{{ $correspondant }}</span>

                    </div>
                </div>
            </a>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-2">
            <div class="card-body">
                <a href="{{ route('Departement') }}" class="nav-link">
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-layers text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total Departement</p>
                        <span class="mb-0 text-white h3">{{ $departement }}</span>

                    </div>
                </div>
            </a>
            </div>
        </div>
    </div>
    <div class="mb-4 col-md-6 col-xl-4">
        <div class="text-white shadow card bg-green-3">
            <div class="card-body">
                <a href="{{ route('Compte') }}" class="nav-link"></a>
                <div class="row align-items-center">
                    <div class="text-center col-3">
                        <span class="circle circle-sm bg-light">
                            <i class="mb-0 fe fe-16 fe-users text-success"></i>
                        </span>
                    </div>
                    <div class="pr-0 col">
                        <p class="mb-0 small text-light">Total utilisateurs</p>
                        <span class="mb-0 text-white h3">{{ $user }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end section -->
{{-- end statisitique --}}
@endif
<div class="row my-4">
    <div class="col-md-12">
      <div class="chart-box">
        <div id="columnChart"></div>
      </div>
    </div> <!-- .col -->
  </div> <!-- end section -->
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
</script>
@endsection

