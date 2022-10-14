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
                <a href="{{ route('Interne') }}" class="nav-link">
                    <div class="row align-items-center">
                        <div class="text-center col-3">
                            <span class="circle circle-sm bg-light">
                                <i class="mb-0 fe fe-16 fe-repeat text-success"></i>
                            </span>
                        </div>
                        <div class="pr-0 col">
                            <p class="mb-0 small text-light">Total interne</p>
                            <span class="mb-0 text-white h3">{{ $interne }}</span>

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
<div class="card">
<div class="row">

    <div class="col-md-6">
        <div class="">

        </div>
    </div>
    <div class="col-md-6">

    </div>
</div>
</div>
</div>
<div class="row my-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="chart-box">
                    <div id="columnChart"></div>
                </div>
            </div>
        </div>

    </div> <!-- .col -->
    {{-- Notifications --}}
    <div class="col-md-4">

        <div class="card p-3">
            <h2>Date: {{ date('d/m/Y') }}</h2>
            <h2 id="time"></h2>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>

            </div>
            <div class="card-body">
                <div class="list-group list-group-flush my-n3">
                    <div class="list-group-item bg-transparent">
                        <div class="row align-items-center">

                            @forelse (Auth::user()->notifications as $row)
                            <div class="col-4">
                                <span class="fe fe-mail fe-24"></span>
                            </div>
                            <div class="col-8">
                                <small><strong>{{ $row->data['title'] }}</strong></small> <br>
                                <small class="badge badge-pill badge-light text-muted">{{
                                    $row->created_at->diffForHumans() }}</small>
                            </div>
                            <hr>
                            @empty
                            <h3>Vous avez aucune notification</h3>
                            @endforelse

                        </div>
                    </div>
                </div> <!-- / .list-group -->
            </div>
        </div>
    </div>
    {{-- fin Notifications --}}
</div> <!-- end section -->

@endsection
@section('chart')
<script type="text/javascript">
      var label_arriver =  {{ Js::from($label_arriver) }};
      var data_arriver =  {{ Js::from($data_arriver) }};

      var label_depart =  {{ Js::from($label_depart) }};
      var data_depart =  {{ Js::from($data_depart) }};
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
                data: data_arriver,
            },
            {
                name: "Depart",
                data: data_depart,
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
            categories: label_arriver,
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
                fillColors: ['#00704D', '#00A97E'],
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
            colors: ['#00704D', '#00A97E'],
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
{{-- date time function --}}
<script>
function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML ="Heure: "+ h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
startTime();
</script>
@endsection
