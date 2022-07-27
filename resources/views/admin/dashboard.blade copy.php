@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
    <style>
        .abc {
            font-weight: bold;
            font-size: 25px;
            font-family: Montserrat;
            text-shadow: #000 0px 0px 3px;
            color: white;
        }

    </style>

@endsection
@section('content')
    {{-- breadcrumb --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
            <!--end page-title-box-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <!-- end page title end breadcrumb -->
    <div class="row">
        @if (auth()->user()->role == 0)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i data-feather="briefcase" class="align-self-center icon-lg icon-dual-warning"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-right">
                                <div class="ml-2">
                                    <p class="mb-1 text-muted"> Total Locations </p>
                                    <h3 class="mt-0 mb-1 font-weight-semibold">{{ totalCompanies() }} </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
        @endif
        @if (auth()->user()->role == 0 || auth()->user()->role == 1)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i data-feather="smile" class="align-self-center icon-lg icon-dual-warning"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-right">
                                <div class="ml-2">
                                    <p class="mb-1 text-muted"> Total Contacts </p>
                                    <h3 class="mt-0 mb-1 font-weight-semibold">{{ totalContacts() }} </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
    </div>
    @endif

    @if (auth()->user()->role == 2)

        <div class="row mt-2 mb-2">
            <div class="col-md-12" style="font-weight: 600 ; font-size:19px;">
                <span class="ml-3"> <img src="https://img.icons8.com/emoji/48/000000/red-square-emoji.png" />
                    BAD
                </span>
                <span class="ml-3"> <img
                        src="https://img.icons8.com/emoji/48/000000/yellow-square-emoji.png" /></i> FAIR </span>
                <span class="ml-3"> <img src="https://img.icons8.com/emoji/48/000000/blue-square-emoji.png" />
                    GOOD </span>
                <span class="ml-3"> <img src="https://img.icons8.com/emoji/48/000000/green-square-emoji.png" />
                    EXCELLENT </span>
            </div>
        </div>

        <div class="card w-100 py-4  text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; ">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="mt-0 header-title text-center">
                        <img src="{{ asset('tr-equifax.jpeg') }}" height="30" width="auto">
                    </h3>
                    <canvas id="demo"></canvas>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="preview-textfield" style="font-size: 22px; font-weight:bold; margin-left:40px;"></div>
                        </div>
                        <div class="col-md-6">
                            {{-- up icon with text --}}
                            <div class="icon-info text-center">
                                <span>{{ round($eq_percentage_change) }} % </span>
                                @if ($eq_percentage_change > 0)
                                    <i data-feather="arrow-up-circle"
                                        class="align-self-center icon-lg icon-dual-warning"></i>
                                @elseif($eq_percentage_change == 0)
                                    <i data-feather="check" class="align-self-center icon-lg icon-dual-warning"></i>
                                @else
                                    <i data-feather="arrow-down-circle"
                                        class="align-self-center icon-lg icon-dual-warning"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="mt-0 header-title text-center">
                        <img src="{{ asset('tr-experian.png') }}" height="30" width="auto">
                    </h3>
                    <canvas id="demo1"></canvas>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="preview-textfield1" style="font-size: 22px; font-weight:bold; margin-left:30px;"></div>
                        </div>
                        <div class="col-md-6">
                            {{-- up icon with text --}}
                            <div class="icon-info text-center">
                                <span>{{ round($ex_percentage_change) }} % </span>
                                @if ($ex_percentage_change > 0)
                                    <i data-feather="arrow-up-circle"
                                        class="align-self-center icon-lg icon-dual-warning"></i>
                                @elseif($ex_percentage_change == 0)
                                    <i data-feather="check" class="align-self-center icon-lg icon-dual-warning"></i>
                                @else
                                    <i data-feather="arrow-down-circle"
                                        class="align-self-center icon-lg icon-dual-warning"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="mt-0 header-title text-center">
                        <img src="{{ asset('tr-transunion.png') }}" height="30" width="auto">
                    </h3>
                    <canvas id="demo2"></canvas>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="preview-textfield2" style="font-size: 22px; font-weight:bold; margin-left:30px;"></div>
                        </div>
                        <div class="col-md-6">
                            {{-- up icon with text --}}
                            <div class="icon-info text-center">
                                <span>{{ round($tr_percentage_change) }} % </span>
                                @if ($tr_percentage_change > 0)
                                    <i data-feather="arrow-up-circle"
                                        class="align-self-center icon-lg icon-dual-warning"></i>
                                @elseif($tr_percentage_change == 0)
                                    <i data-feather="check" class="align-self-center icon-lg icon-dual-warning"></i>
                                @else
                                    <i data-feather="arrow-down-circle"
                                        class="align-self-center icon-lg icon-dual-warning"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            @include('admin.user.m-to-m', get_defined_vars())
        </div>
    @endif
@endsection

@section('js')
    @if (auth()->user()->role == 2)
        <script src="{{ asset('assets/gauge-charts/dist/gauge.js') }}"></script>
        <script>
            function setGauge(divId, scoreId, score) {
                var opts = {
                
                    pointer: {
                        length: 0.0,
                        strokeWidth: 0.035,
                        iconScale: 1.0
                    },
                    // static labels
                    staticLabels: {
                        font: "10px sans-serif",
                        labels: [300, 629, 689, 719, 850],
                        fractionDigits: 0
                    },
                    // static zones
                    staticZones: [{
                            strokeStyle: "red",
                            min: 300,
                            max: 629
                        },
                        {
                            strokeStyle: "yellow",
                            min: 630,
                            max: 689
                        },
                        {
                            strokeStyle: "blue",
                            min: 690,
                            max: 719
                        },
                        {
                            strokeStyle: "green",
                            min: 720,
                            max: 1000
                        },

                    ],
                    // render ticks
                    renderTicks: {
                        divisions: 4,
                        divWidth: 1.1,
                        divLength: 0.7,
                        divColor: 'transparent',
                        subDivisions: 0,
                        subLength: 0.5,
                        subWidth: 0.6,
                        subColor: 'transparent',
                    },
                    // the span of the gauge arc
                    angle: 0,
                    // line thickness
                    lineWidth: 0.1,
                    // radius scale
                    radiusScale: 1.0,
                    // font size
                    fontSize: 40,
                    // if false, max value increases automatically if value > maxValue
                    limitMax: true,
                    // if true, the min value of the gauge will be fixed
                    limitMin: true,
                    // High resolution support
                    highDpiSupport: true,
                  

                };
                var target = document.getElementById(divId);
                var gauge = new Gauge(target).setOptions(opts);

                document.getElementById(scoreId).className = scoreId;
                gauge.setTextField(document.getElementById(scoreId));

                gauge.maxValue = 850;
                gauge.setMinValue(300);
                gauge.set(score);

                gauge.animationSpeed = 200;
            }

            setGauge('demo', 'preview-textfield', {{ $last_eq_riskScore }});
            setGauge('demo1', 'preview-textfield1', {{ $last_ex_riskScore }});
            setGauge('demo2', 'preview-textfield2', {{ $last_tr_riskScore }});


            //setting the datatable
        </script>
    @endif
@endsection
