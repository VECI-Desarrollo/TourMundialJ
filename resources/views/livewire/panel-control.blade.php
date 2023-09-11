<div style="margin-top: 70px;" id="body">

    {{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  --}}

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



    <!-- Navbar -->



    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <!-- Website Analytics-->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card" data-tour-index="1" data-tour-title="Registros-Totales"
                    data-tour-description="Aqui encontraras información general de los registros ">
                    <div class="card-header d-flex justify-content-between align-items-center" data-tour-index="2"
                        data-tour-title="Total por año"
                        data-tour-description="Muestra el numero total de registros del año en curso ">
                        <h5 class="card-title mb-0">
                            <button id="start-tour" class="btn btn-primary">Start Tour</button>
                            @if (auth()->user()->rol == 'admin')
                                <select wire:model="Year" class="custom-select">
                                    @foreach ($años as $año)
                                        <option value="{{ $año }}">{{ $año }}</option>
                                    @endforeach
                                </select>
                            @else
                                {{ date('Y') }}
                            @endif

                            <style>
                                .custom-select {
                                    display: inline-block;
                                    font-size: 14px;
                                    /* Tamaño de fuente ajustado */
                                    border: 1px solid #ccc;
                                    border-radius: 10px 10px 0px 0px;
                                    /* Agregamos bordes redondeados */
                                    padding: 2px 25px 2px 5px;
                                    background-color: white;
                                    background-image: url('icono-seleccion.png');
                                    /* Agrega el icono del selector */
                                    background-repeat: no-repeat;
                                    background-position: right center 8px;
                                    /* Alinea el icono con el texto */
                                    appearance: none;
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    cursor: pointer;
                                }

                                .custom-select:focus {
                                    outline: none;
                                    border-color: #999;
                                    /* Cambia el color del borde al hacer focus */
                                    box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
                                    /* Agrega una sombra al hacer focus */
                                }

                                .custom-select option:hover {
                                    background-color: #ccc;
                                    /* Cambia el color de fondo al hacer hover */
                                    color: black;
                                    /* Cambia el color del texto al hacer hover */
                                }
                            </style>

                            Registros totales ( {{ $totalRegistros->total_registros }} )
                        </h5>
                        {{--  permisos admin  --}}
                        @if (auth()->user()->rol == 'admin')
                            <select wire:model="vendedor" class="custom-select">
                                <option value="0" selected> --Todos-- </option>
                                @foreach ($vendedores as $ven)
                                    <option value="{{ $ven->id }}">{{ $ven->nombre . $ven->apellido }}</option>
                                @endforeach
                            </select>


                            <div wire:loading wire:target="Year,vendedor">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        @endif {{-- -end if permisos select vendedores- --}}


                        {{--  <div class="dropdown">
              <button class="btn p-0" type="button" id="analyticsOptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="analyticsOptions">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>  --}}
                    </div>
                    <div class="card-body pb-2">
                        <div class="d-flex justify-content-around align-items-center flex-wrap mb-4">
                            <div class="user-analytics text-center me-2" data-tour-index="3"
                                data-tour-title="Total-Aceptados"
                                data-tour-description="Muestra el numero total de registros aceptados del año en curso.(La grafica representa el porcentaje en proporción al total general) ">
                                <i class="bx bx-check me-1"></i>
                                <span>Aceptados</span>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="chart-report" data-color="success"
                                        data-series="{{ $porcentaje = $totalRegistros->total_registros !== 0 ? ($registrosAceptados->total_registros / $totalRegistros->total_registros) * 100 : 0 }}">
                                    </div>
                                    <h3 class="mb-0">{{ $registrosAceptados->total_registros }}</h3>
                                </div>
                            </div>
                            <div class="sessions-analytics text-center me-2" data-tour-index="4"
                                data-tour-title="Total-En-Curso"
                                data-tour-description="Muestra el numero total de registros en curso (por definir su aceptación o rechazo) del año en curso.(La grafica representa el porcentaje en proporción al total general) ">
                                <i class="bx bx-time-five me-1"></i>
                                <span>En curso</span>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="chart-report" data-color="warning"
                                        data-series="{{ $porcentaje = $totalRegistros->total_registros !== 0 ? ($totalRegistros->registros_en_curso / $totalRegistros->total_registros) * 100 : 0 }}">
                                    </div>
                                    <h3 class="mb-0">{{ $totalRegistros->registros_en_curso }}</h3>
                                </div>
                            </div>
                            <div class="bounce-rate-analytics text-center" data-tour-index="5"
                                data-tour-title="Total-Rechazados"
                                data-tour-description="Muestra el numero total de registros rechazados del año en curso.(La grafica representa el porcentaje en proporción al total general) ">
                                <i class="bx bx-task-x me-1"></i>
                                <span>Rechazados</span>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="chart-report" data-color="danger"
                                        data-series="{{ $porcentajeRechazados = $totalRegistros->total_registros !== 0 ? ($totalRegistros->registros_rechazados / $totalRegistros->total_registros) * 100 : 0 }}">
                                    </div>
                                    <h3 class="mb-0">{{ $totalRegistros->registros_rechazados }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="text-center" data-tour-index="6" data-tour-title="Grafica-año/mes"
                            data-tour-description="Muestra el número total de registros de forma detallada por mes y año. Posando el puntero sobre la linea de la grafica puede ver información de los registros del mes correspondiente, cada mes muestra el detalle del valor monetario y su estado.">
                            Grafica de todos regstros por año
                            <div id="chart"></div>
                        </div>

                    </div>
                </div>

            </div>
            @push('js')
                <script>
                    // Supongamos que tienes un arreglo de meses llamado "months" y una función "getSalesData()" que devuelve los valores de ventas para cada mes.
                    let months =
                    @json($months); // Asegúrate de convertir el arreglo PHP en un arreglo JSON para JavaScript.
                    let salesData = @json($this->getSalesData()); // Reemplaza "$this" por el nombre de tu componente Livewire.
                    let YearData = @json($this->RegistrosYearDiv());

                    var options = {
                        series: YearData,
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: months,
                        },
                        yaxis: {
                            title: {
                                text: '(Registros)'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val, {
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    var year = w.globals.seriesX[seriesIndex];
                                    var count = YearData[seriesIndex].data[dataPointIndex];
                                    var month = months[dataPointIndex];

                                    var countAceptadoCLP = YearData[seriesIndex].count_aceptado_CLP[dataPointIndex];
                                    var countRechazadoCLP = YearData[seriesIndex].count_rechazado_CLP[dataPointIndex];
                                    var countEnCursoCLP = YearData[seriesIndex].count_en_curso_CLP[dataPointIndex];
                                    var countAceptadoEUR = YearData[seriesIndex].count_aceptado_EUR[dataPointIndex];
                                    var countRechazadoEUR = YearData[seriesIndex].count_rechazado_EUR[dataPointIndex];
                                    var countEnCursoEUR = YearData[seriesIndex].count_en_curso_EUR[dataPointIndex];
                                    var countAceptadoUSD = YearData[seriesIndex].count_aceptado_USD[dataPointIndex];
                                    var countRechazadoUSD = YearData[seriesIndex].count_rechazado_USD[dataPointIndex];
                                    var countEnCursoUSD = YearData[seriesIndex].count_en_curso_USD[dataPointIndex];

                                    var sumAceptadoCLP = YearData[seriesIndex].sum_aceptado_CLP[dataPointIndex];
                                    var sumRechazadoCLP = YearData[seriesIndex].sum_rechazado_CLP[dataPointIndex];
                                    var sumEnCursoCLP = YearData[seriesIndex].sum_en_curso_CLP[dataPointIndex];
                                    var sumAceptadoEUR = YearData[seriesIndex].sum_aceptado_EUR[dataPointIndex];
                                    var sumRechazadoEUR = YearData[seriesIndex].sum_rechazado_EUR[dataPointIndex];
                                    var sumEnCursoEUR = YearData[seriesIndex].sum_en_curso_EUR[dataPointIndex];
                                    var sumAceptadoUSD = YearData[seriesIndex].sum_aceptado_USD[dataPointIndex];
                                    var sumRechazadoUSD = YearData[seriesIndex].sum_rechazado_USD[dataPointIndex];
                                    var sumEnCursoUSD = YearData[seriesIndex].sum_en_curso_USD[dataPointIndex];


                                    return (
                                        val + " Registros<br>" +
                                        " Registros aceptados CLP: " + countAceptadoCLP + " - Total: " + sumAceptadoCLP +
                                        "<br>" +
                                        " Registros rechazados CLP: " + countRechazadoCLP + " - Total: " + sumRechazadoCLP +
                                        "<br>" +
                                        " Registros en curso CLP: " + countEnCursoCLP + " - Total: " + sumEnCursoCLP +
                                        "<br>" + "<hr>" +
                                        " Registros aceptados EUR: " + countAceptadoEUR + " - Total: " + sumAceptadoEUR +
                                        "<br>" +
                                        " Registros rechazados EUR: " + countRechazadoEUR + " - Total: " + sumRechazadoEUR +
                                        "<br>" +
                                        " Registros en curso EUR: " + countEnCursoEUR + " - Total: " + sumEnCursoEUR +
                                        "<br>" + "<hr>" +
                                        " Registros aceptados USD: " + countAceptadoUSD + " - Total: " + sumAceptadoUSD +
                                        "<br>" +
                                        " Registros rechazados USD: " + countRechazadoUSD + " - Total: " + sumRechazadoUSD +
                                        "<br>" +
                                        " Registros en curso USD: " + countEnCursoUSD + " - Total: " + sumEnCursoUSD
                                    );
                                }
                            }

                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                </script>
            @endpush
            @stack('js')
            <!-- Referral, conversion, impression & income charts -->

            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <!-- Referral Chart-->
                    <div class="col-sm-6 col-12 mb-4">
                        <div class="card">

                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            <span class=" fi fi-cl fis rounded-circle fs-4 me-1"></span>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="card-title mb-0 me-2">
                                                <div wire:loading.remove wire:target="Year,vendedor">
                                                    $
                                                    {{ isset($registrosAceptados->suma_monto_clp) ? $registrosAceptados->suma_monto_clp : 0 }}
                                                </div>
                                                <div wire:loading wire:target="Year, vendedor">
                                                    <div class="lds-ellipsis">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </h5>

                                            <small class="text-muted">CLP valor de registros aceptados</small>
                                        </div>
                                    </div>
                                    {{--  <div id="conversationChart"></div>  --}}
                                </div>
                            </div>
                        </div><br>
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar">
                                                <span class=" fi fi-eu fis rounded-circle fs-4 me-1"></span>
                                            </div>
                                            <div class="card-info">
                                                <h5 class="card-title mb-0 me-2">
                                                    <div wire:loading.remove wire:target="Year,vendedor">
                                                        $
                                                        {{ isset($registrosAceptados->suma_monto_eur) ? $registrosAceptados->suma_monto_eur : 0 }}
                                                    </div>
                                                    <div wire:loading wire:target="Year,vendedor">
                                                        <div class="lds-ellipsis">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </h5>
                                                <small class="text-muted">EUR valor de registros aceptados</small>
                                            </div>
                                        </div>
                                        {{--  <div id="incomeChart"></div>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar">
                                                <span class=" fi fi-us fis rounded-circle fs-4 me-1"></span>
                                            </div>
                                            <div class="card-info">
                                                <h5 class="card-title mb-0 me-2">
                                                    <div wire:loading.remove wire:target="Year,vendedor">
                                                        $
                                                        {{ isset($registrosAceptados->suma_monto_usd) ? $registrosAceptados->suma_monto_usd : 0 }}
                                                    </div>
                                                    <div wire:loading wire:target="Year, vendedor">
                                                        <div class="lds-ellipsis">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </h5>
                                                <small class="text-muted">USD valor de registros aceptados </small>
                                            </div>
                                        </div>
                                        {{--  <div id="incomeChart"></div>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-12 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Balnce</h5>
                                </div>
                                <div class="card-body d-flex align-items-end justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center gap-3 w-100">
                                        <div class="d-flex align-content-center">
                                            <div class="chart-report" data-color="danger" data-series="25"></div>
                                            <div class="chart-info">
                                                <h5 class="mb-0">$12k</h5>
                                                <small class="text-muted">2020</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-content-center">
                                            <div class="chart-report" data-color="info" data-series="50"></div>
                                            <div class="chart-info">
                                                <h5 class="mb-0">$64k</h5>
                                                <small class="text-muted">2021</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Conversion Chart-->
                    <div class="col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"> Actividad semanal
                                    {{--  @if (auth()->user()->rol == 'admin')  --}}
                                    <select wire:model="moneda" class="custom-select">
                                        @foreach ($monedas as $money)
                                            <option value="{{ $money->moneda }}">{{ $money->moneda }}</option>
                                        @endforeach
                                    </select>
                                    {{--  @endif  --}}
                                </h5>

                                <small class="text-muted">
                                    {{ auth()->user()->rol == 'admin' && isset($vendedorNom) ? 'Vendedor: ' . $vendedorNom['nombre_completo'] : (isset($vendedorNom) ? $vendedorNom['nombre_completo'] : 'Debe seleccionar un vendedor') }}
                                    <br>
                                    Registros totales: {{ $actividadSemanal['total_registros'] }}
                                    <br>{{-- --se accede como array- --}}
                                    Semana del {{ $this->startDateOfWeek }} al {{ $this->endDateOfWeek }}</small>
                                <div wire:loading wire:target="moneda">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-4 pb-2">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded-circle bg-label-primary"><i
                                                    class='bx bx-cube'></i></span>
                                        </div>
                                        <div class="d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>Ventas totales </span>
                                                <span class="text-muted">$
                                                    {{ isset($actividadSemanal['suma_monto']) ? $actividadSemanal['suma_monto'] : 0 }}</span>
                                            </div>
                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar bg-primary" style="width: 100%"
                                                    role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-2">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded-circle bg-label-success"><i
                                                    class='bx bx-dollar'></i></span>
                                        </div>
                                        <div class="d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>{{ $actividadSemanal['count_aceptado'] }} / Aceptadas</span>
                                                <span class="text-muted">$
                                                    {{ isset($actividadSemanal['suma_aceptado']) ? $actividadSemanal['suma_aceptado'] : 0 }}</span>
                                            </div>
                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar bg-success"
                                                    style="width: {{ $actividadSemanal['count_aceptado'] !== 0
                                                        ? ($actividadSemanal['total_registros'] / $actividadSemanal['count_aceptado']) * 100
                                                        : 0 }}%"
                                                    role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-2">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded-circle bg-label-warning"><i
                                                    class='bx bx-trending-up'></i></span>
                                        </div>
                                        <div class="d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span> {{ $actividadSemanal['count_en_curso'] }} / En curso</span>
                                                <span class="text-muted">$
                                                    {{ isset($actividadSemanal['suma_en_curso']) ? $actividadSemanal['suma_en_curso'] : 0 }}</span>
                                            </div>
                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar bg-warning"
                                                    style="width: {{ $actividadSemanal['count_en_curso'] !== 0
                                                        ? ($actividadSemanal['total_registros'] / $actividadSemanal['count_en_curso']) * 100
                                                        : 0 }}%"
                                                    role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-2">
                                        <div class="avatar avatar-sm flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded-circle bg-label-danger"><i
                                                    class='bx bx-message-square-x'></i></span>
                                        </div>
                                        <div class="d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span> {{ $actividadSemanal['count_rechazado'] }} / Rechazadas</span>
                                                <span class="text-muted">$
                                                    {{ isset($actividadSemanal['suma_en_rechazado']) ? $actividadSemanal['suma_en_rechazado'] : 0 }}</span>
                                            </div>
                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar bg-danger"
                                                    style="width:{{ $actividadSemanal['count_rechazado'] !== 0
                                                        ? ($actividadSemanal['total_registros'] / $actividadSemanal['count_rechazado']) * 100
                                                        : 0 }}%"
                                                    role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    {{--  <!-- Impression Radial Chart-->
          <div class="col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body text-center">
                <div id="impressionDonutChart"></div>
              </div>
            </div>
          </div>  --}}
                    <!-- Growth Chart-->
                    {{--  <div class="col-sm-6 col-12">
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                          <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                        </div>
                        <div class="card-info">
                          <h5 class="card-title mb-0 me-2">$38,566</h5>
                          <small class="text-muted">Conversion</small>
                        </div>
                      </div>
                      <div id="conversationChart"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                          <span class="avatar-initial bg-label-warning rounded-circle"><i class="bx bx-dollar fs-4"></i></span>
                        </div>
                        <div class="card-info">
                          <h5 class="card-title mb-0 me-2">$53,659</h5>
                          <small class="text-muted">Income</small>
                        </div>
                      </div>
                      <div id="incomeChart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  --}}
                </div>
            </div>
            <!--/ Referral, conversion, impression & income charts -->

            {{--  <!-- Activity -->
      <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">Activity</h5>
          </div>
          <div class="card-body">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-2">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <span class="avatar-initial rounded-circle bg-label-primary"><i class='bx bx-cube'></i></span>
                </div>
                <div class="d-flex flex-column w-100">
                  <div class="d-flex justify-content-between mb-1">
                    <span>Total Sales</span>
                    <span class="text-muted">$2,459</span>
                  </div>
                  <div class="progress" style="height:6px;">
                    <div class="progress-bar bg-primary" style="width: 40%" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-2">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <span class="avatar-initial rounded-circle bg-label-success"><i class='bx bx-dollar'></i></span>
                </div>
                <div class="d-flex flex-column w-100">
                  <div class="d-flex justify-content-between mb-1">
                    <span>Income</span>
                    <span class="text-muted">$8,478</span>
                  </div>
                  <div class="progress" style="height:6px;">
                    <div class="progress-bar bg-success" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-2">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <span class="avatar-initial rounded-circle bg-label-warning"><i class='bx bx-trending-up'></i></span>
                </div>
                <div class="d-flex flex-column w-100">
                  <div class="d-flex justify-content-between mb-1">
                    <span>Budget</span>
                    <span class="text-muted">$12,490</span>
                  </div>
                  <div class="progress" style="height:6px;">
                    <div class="progress-bar bg-warning" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-2">
                <div class="avatar avatar-sm flex-shrink-0 me-3">
                  <span class="avatar-initial rounded-circle bg-label-danger"><i class='bx bx-check'></i></span>
                </div>
                <div class="d-flex flex-column w-100">
                  <div class="d-flex justify-content-between mb-1">
                    <span>Tasks</span>
                    <span class="text-muted">$184</span>
                  </div>
                  <div class="progress" style="height:6px;">
                    <div class="progress-bar bg-danger" style="width: 25%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Activity -->  --}}

            {{--  <!-- Profit Report & Registration -->
      <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-12 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <h5 class="card-title mb-0">Profit Report</h5>
              </div>
              <div class="card-body d-flex align-items-end justify-content-between">
                <div class="d-flex justify-content-between align-items-center gap-3 w-100">
                  <div class="d-flex align-content-center">
                    <div class="chart-report" data-color="danger" data-series="25"></div>
                    <div class="chart-info">
                      <h5 class="mb-0">$12k</h5>
                      <small class="text-muted">2020</small>
                    </div>
                  </div>
                  <div class="d-flex align-content-center">
                    <div class="chart-report" data-color="info" data-series="50"></div>
                    <div class="chart-info">
                      <h5 class="mb-0">$64k</h5>
                      <small class="text-muted">2021</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-12 mb-4">
            <div class="card">
              <div class="card-header pb-2">
                <h5 class="card-title mb-0">Registration</h5>
              </div>
              <div class="card-body pb-2">
                <div class="d-flex justify-content-between align-items-end gap-3">
                  <div class="mb-3">
                    <div class="d-flex align-content-center">
                      <h5 class="mb-1">58.4k</h5>
                      <i class="bx bx-chevron-up text-success"></i>
                    </div>
                    <small class="text-success">12.8%</small>
                  </div>
                  <div id="registrationsBarChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Profit Report & Registration -->  --}}

            <!-- Sales -->
            {{--  <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
        <div class="card">
          <div class="card-header d-flex align-items-start justify-content-between">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Ventas</h5>
              <small class="card-subtitle text-muted">Calculo de los ultimos 7 dias</small>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="salesReport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesReport">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="salesChart"></div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-3">
                <span class="text-primary me-2"><i class='bx bx-up-arrow-alt bx-sm'></i></span>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0 lh-1">Mejor dia</h6>
                    <small class="text-muted">Lunes</small>
                  </div>
                  <div class="item-progress">$28,000.</div>
                </div>
              </li>
              <li class="d-flex">
                <span class="text-secondary me-2"><i class='bx bx-down-arrow-alt bx-sm'></i></span>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0 lh-1">Pero dia</h6>
                    <small class="text-muted">Jueves</small>
                  </div>
                  <div class="item-progress">5.000</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>  --}}
            <!--/ Sales -->

            {{--  <!-- Growth Chart-->
      <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <div class="dropdown mb-4">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                2020
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonSec">
                <a class="dropdown-item" href="javascript:void(0);">2022</a>
                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                <a class="dropdown-item" href="javascript:void(0);">2020</a>
              </div>
            </div>
            <div id="growthRadialChart"></div>
            <h6 class="mb-0 mt-5"> 62% Growth in 2022</h6>
          </div>
        </div>
      </div>
      <!-- Growth Chart-->  --}}

            <!-- Finance Summary -->
            {{--  <div class="col-md-7 col-lg-7 mb-4 mb-md-0">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center me-3">
              <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle me-3" width="54">
              <div class="card-title mb-0">
                <h5 class="mb-0">finanzas</h5>
                <small class="text-muted">Reporte y mensajes </small>
              </div>
            </div>
            <div class="dropdown btn-pinned">
              <button class="btn p-0" type="button" id="financoalReport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="financoalReport">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex flex-wrap gap-4 mb-5 mt-4">
              <div class="d-flex flex-column me-2">
                <h6>Start Date</h6>
                <span class="badge bg-label-success">02 APR 22</span>
              </div>
              <div class="d-flex flex-column me-2">
                <h6>End Date</h6>
                <span class="badge bg-label-danger">06 MAY 22</span>
              </div>
              <div class="d-flex flex-column me-2">
                <h6>Members</h6>
                <ul class="list-unstyled me-2 d-flex align-items-center avatar-group mb-0">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-xs pull-up">
                    <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar avatar-xs pull-up">
                    <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar avatar-xs pull-up">
                    <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Ellen Wagner" class="avatar avatar-xs pull-up">
                    <img class="rounded-circle" src="../../assets/img/avatars/14.png" alt="Avatar">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Darcey Nooner" class="avatar avatar-xs pull-up">
                    <img class="rounded-circle" src="../../assets/img/avatars/10.png" alt="Avatar">
                  </li>
                </ul>
              </div>
              <div class="d-flex flex-column me-2">
                <h6>Budget</h6>
                <span>$249k</span>
              </div>
              <div class="d-flex flex-column me-2">
                <h6>Expenses</h6>
                <span>$82k</span>
              </div>
            </div>
            <div class="d-flex flex-column flex-grow-1">
              <span class="text-nowrap d-block mb-1">Kiara Cruiser Progress</span>
              <div class="progress w-100 mb-3" style="height: 8px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <span>I distinguish three main text objectives. First, your objective could be merely to inform people. A second be to persuade people.</span>
          </div>
          <div class="card-footer border-top">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><i class="bx bx-check"></i> 74 Tasks</li>
              <li class="list-inline-item"><i class="bx bx-chat"></i> 678 Comments</li>
            </ul>
          </div>
        </div>
      </div>  --}}
            <!-- Finance Summary -->

            {{--  <!-- Activity Timeline -->
      <div class="col-md-5 col-lg-5 mb-0">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Activity Timeline</h5>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="timelineWapper" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Activity Timeline -->
            <ul class="timeline">
              <li class="timeline-item timeline-item-transparent ps-4">
                <span class="timeline-point timeline-point-primary"></span>
                <div class="timeline-event pb-2">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">12 Invoices have been paid</h6>
                    <small class="text-muted">12 min ago</small>
                  </div>
                  <p class="mb-2">Invoices have been paid to the company</p>
                  <div class="d-flex">
                    <a href="javascript:void(0)" class="me-3">
                      <img src="../../assets/img/icons/misc/pdf.png" alt="PDF image" width="23" class="me-2">
                      <span class="fw-bold text-body">Invoices.pdf</span>
                    </a>
                  </div>
                </div>
              </li>
              <li class="timeline-item timeline-item-transparent ps-4">
                <span class="timeline-point timeline-point-warning"></span>
                <div class="timeline-event pb-2">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">Client Meeting</h6>
                    <small class="text-muted">45 min ago</small>
                  </div>
                  <p class="mb-2">Project meeting with john @10:15am</p>
                  <div class="d-flex flex-wrap">
                    <div class="avatar me-3">
                      <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div>
                      <h6 class="mb-0">John Doe (Client)</h6>
                      <span class="text-muted">CEO of Pixinvent</span>
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item timeline-item-transparent ps-4">
                <span class="timeline-point timeline-point-info"></span>
                <div class="timeline-event pb-0">
                  <div class="timeline-header mb-1">
                    <h6 class="mb-0">Create a new project for client</h6>
                    <small class="text-muted">2 Day Ago</small>
                  </div>
                  <p class="mb-2">5 team members in a project</p>
                  <div class="d-flex align-items-center avatar-group">
                    <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy">
                      <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                      <img src="../../assets/img/avatars/12.png" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Jackson">
                      <img src="../../assets/img/avatars/9.png" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristine Gill">
                      <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="avatar avatar-sm pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nelson Wilson">
                      <img src="../../assets/img/avatars/14.png" alt="Avatar" class="rounded-circle">
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-end-indicator">
                <i class="bx bx-check-circle"></i>
              </li>
            </ul>
            <!-- /Activity Timeline -->
          </div>
        </div>
      </div>
      <!--/ Activity Timeline -->
    </div>  --}}

        </div>

        <!--/ Content -->




        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    Registro <a href="#" target="_blank" class="footer-link fw-semibold">TourMundial</a>
                </div>
                <div>

                    {{--  <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
          <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>

          <a href="https://demos.pixinvent.com/frest-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>


          <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>  --}}

                </div>
            </div>
        </footer>
        <!-- / Footer -->


        <div class="content-backdrop fade"></div>
    </div>
    <!--/ Content wrapper -->
</div>

<!--/ Layout container -->
</div>

</div>



<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>


<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>

<!--/ Layout wrapper -->




















{{--

    <div class="text-center mt-10">
        <div class="row mt-5">
            <div class="col-sm-4">
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarVendedor">
                   Agregar Vendedor
                  </button>
            </div>
            <div class="col-sm-4">
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarTipoPagoModal">
                   Agregar Tipo de pago
                  </button>
            </div>
            <div class="col-sm-4">
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarProductoPagadoModal">
                   Agregar producto
                  </button>
            </div>
          </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar" wire:model="search">
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Agencia</th>
                <th>Expediente</th>
                <th>Tipo de Pago</th>
                <th>Monto</th>
                <th>Comprobante</th>
                <th>Tipo de Producto</th>
                <th>Moneda</th>
                <th>Fecha de Depósito</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($registros as $registro)
              <tr>
                <td>{{ $registro->agenciaNombre }}</td>
                <td>{{ $registro->expediente }}</td>
                <td>{{ $registro->tiposPagos_id }}</td>
                <td>${{ $registro->monto }}</td>
                <td>{{ $registro->comprobante }}</td>
                <td>{{ $registro->tiposProductos_id }}</td>
                <td>{{ $registro->moneda }}</td>
                <td>{{ $registro->fechaDeposito }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-4">
          {{ $registros->links() }}
        </div>


    </div>  --}}




 {{--  <livewire:auth.registro-user />  --}}






<script>
    window.livewire.on('reloadClassCSs', function() {

        // Reinicializar el script después de cada actualización de Livewire
        var script = document.createElement('script');
        script.src = 'assets/js/dashboards-analytics.js';
        script.defer = true;
        document.body.appendChild(script);



    });
</script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="{{ asset('js/tour.js') }}"></script>

<!-- Instantiate the page tour library -->
<script>
    // Instantiate the actual page tour object.
    var PageTour;
    try {
        PageTour = $.fn.PageTour();
    } catch (e) {
        console.error('Cannot start page tour: ', e);
    }
</script>

<!-- Just some extra testing functionality -->
<script>
    // Script to add dynamic "cities" for testing.
    $('#start-tour').on('click', PageTour.open);


    // Test after load adding new elements.
    var locs = [{
            loc: 'Emerald City',
            p1: 'Emerald City is located somewhere over the rainbow.',
            p2: 'Emerald  has munchkins, witches, and talking scarecrows. I wouldn\'t recommend it.'
        },
        {
            loc: 'Wonderland',
            p1: 'Wonderland is situated behind a mirror.',
            p2: 'If you ever wondered what life would be like on a permanent acid trip, Wonderland is for you.'
        }
    ];
</script>



</div>
