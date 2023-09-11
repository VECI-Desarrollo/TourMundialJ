<?php

namespace App\Http\Livewire;

use App\Models\monedas;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\registrospagosagencias;
use App\Models\vendedores;
use Carbon\Carbon;
class PanelControl extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; //para dar e estilo numerico al paginador
    public $registrosEnCurso,
           $registrosAceptados,
           $registrosRechazados,
           $totalRegistros,
           $Year,
           $años,
           $actividadSemanal,
           $monedas,/// variable para el select de moneas 
           $moneda,/// variable para la seleccion de moenda
         ////// marcadores de icicio y fin de seman para el widget  Actividad semenal  
         $startDateOfWeek,
         $endDateOfWeek,
         ///// vendedoores lista  <select>
         $vendedores,
         /// vendedore selececcion (id)
         $vendedor,
         /// vendeor nombre concat
         $vendedorNom;



    public function mount()
    {
   $this->Year = date('Y');
   $this->moneda='CLP';// inicializar  Moneda en clp
   ////// inicialiar vendedor por defecto si , el admin  u otro prefl con permisos inicia session
   // si el admin esta definido se inicializa en cero 
   // si no esta definido admin u otro con permisos se pasa el id del vendedor por defecto
   $this->vendedor =  (auth()->user()->rol == "admin") ? 0 : auth()->user()->id ;
   
    }       


    public $months = [
        'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
    ];

    protected $listeners = ['refreshPanel' => '$refresh'];

    public function getSalesData()
    {
        // Aquí debes implementar la lógica para obtener los valores de ventas para cada mes.
        // Puedes obtenerlos de una base de datos, una API o cualquier otra fuente de datos.
        // En este ejemplo, simplemente devolveré valores aleatorios para representar los datos.
        return collect($this->months)->map(function () {
            return rand(50, 200);
        })->toArray();
    }


    /////// get años 
    public function getYears()
    {

        $registros = registrospagosagencias::when(($this->vendedor != 0), function ($query)  {
            $query->where('id_vendedor', $this->vendedor);
        })->get(); // Obtenemos los registros

        return $this->años = $registros->pluck('created_at')->map(function ($fecha) {
            return \Carbon\Carbon::parse($fecha)->format('Y');
        })->unique();

        
    }

    ////// metodo para el apex chart

    public function RegistrosYearDiv()
    {
        $records = registrospagosagencias::
        when(($this->vendedor != 0), function ($query)  {
            $query->where('id_vendedor', $this->vendedor);
        })->get();

       

    // Obtener años diferentes de los registros
    $years = $records->map(function ($record) {
        return $record->created_at->format('Y');
    })->unique()->values();


    
    // Obtener el número de registros y la suma de monto por mes, moneda y estado para cada año
    $data = [];
    foreach ($years as $year) {
        $monthlyCounts = [];
             /// CLP 
             $monthlySumsCLPaceptado= [] ;
             $monthlySumsCLPRechazado= [] ;
             $monthlySumsCLPcurso= [] ;
             /// Eur
             $monthlySumsEURaceptado= [] ;
             $monthlySumsEURrechazado= [] ;
             $monthlySumsEURcurso= [] ;
             /// USD
             $monthlySumsUSDaceptado= [] ;
             $monthlySumsUSDrechazado= [] ;
             $monthlySumsUSDcurso= [] ;
 
             /// totales //////////////////////
             //== CLP
             $monthlyCountsAceptadoCLP = [] ;
             $monthlyCountsRechazadoCLP = [] ;
             $monthlyCountscursoCLP = [] ;
                //== EUR
                $monthlyCountsAceptadoEUR = [] ;
                $monthlyCountsRechazadoEUR = [] ;
                $monthlyCountscursoEUR = [] ;
                 //== USD
                 $monthlyCountsAceptadoUSD = [] ;
 
                 $monthlyCountsRechazadoUSD = [] ;
 
                 $monthlyCountscursoUSD = [] ;
 

        for ($month = 1; $month <= 12; $month++) {
            $count = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->count();
              //// CLP
            $sumCLPaceptado = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'aceptado')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'CLP');
             
                $sumCLPrechazado = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'rechazado')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'CLP');
               
                $sumCLPcurso = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'en curso')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'CLP');
         

              //// EUR
            $sumEURaceptado = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'aceptado')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'EUR');

                $sumEURrechazado = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'rechazado')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'EUR');
             
                $sumEURcurso = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'en curso')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'EUR');
            

             //// USD
            $sumUSDaceptado = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'aceptado')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'USD');

                $sumUSDrechazado = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'rechazado')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'USD');
             
                $sumUSDcurso = registrospagosagencias::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('estado', 'en curso')
                ->when(($this->vendedor != 0), function ($query)  {
                    $query->where('id_vendedor', $this->vendedor);
                })
                ->where('moneda', 'USD');
               

         

            $monthlyCounts[] = $count;
            /// CLP 
            $monthlySumsCLPaceptado[] = $sumCLPaceptado->sum('monto');
            $monthlySumsCLPRechazado[] = $sumCLPrechazado->sum('monto');
            $monthlySumsCLPcurso[] = $sumCLPcurso->sum('monto');
            /// Eur
            $monthlySumsEURaceptado[] = $sumEURaceptado->sum('monto');
            $monthlySumsEURrechazado[] = $sumEURrechazado->sum('monto');
            $monthlySumsEURcurso[] = $sumEURcurso->sum('monto');
            /// USD
            $monthlySumsUSDaceptado[] = $sumUSDaceptado->sum('monto');
            $monthlySumsUSDrechazado[] = $sumUSDrechazado->sum('monto');
            $monthlySumsUSDcurso[] = $sumUSDcurso->sum('monto');

            /// totales //////////////////////
            //== CLP
            $monthlyCountsAceptadoCLP[] = $sumCLPaceptado->count();
            $monthlyCountsRechazadoCLP[] = $sumCLPrechazado->count();
            $monthlyCountscursoCLP[] = $sumCLPcurso->count();
               //== EUR
               $monthlyCountsAceptadoEUR[] = $sumEURaceptado->count();
               $monthlyCountsRechazadoEUR[] = $sumEURrechazado->count();
               $monthlyCountscursoEUR[] = $sumEURcurso->count();
                //== USD
                $monthlyCountsAceptadoUSD[] = $sumUSDaceptado->count();
                $monthlyCountsRechazadoUSD[] = $sumUSDrechazado->count();
                $monthlyCountscursoUSD[] = $sumUSDcurso->count();

                

        }

        $data[] = [
            'name' => $year,
            'data' => $monthlyCounts,
            'count_aceptado_CLP' => $monthlyCountsAceptadoCLP,
            'count_rechazado_CLP' => $monthlyCountsRechazadoCLP,
            'count_en_curso_CLP' => $monthlyCountscursoCLP,
            'count_aceptado_EUR' => $monthlyCountsAceptadoEUR,
            'count_rechazado_EUR' => $monthlyCountsRechazadoEUR,
            'count_en_curso_EUR' => $monthlyCountscursoEUR,
            'count_aceptado_USD' => $monthlyCountsAceptadoUSD,
            'count_rechazado_USD' => $monthlyCountsRechazadoUSD,
            'count_en_curso_USD' => $monthlyCountscursoUSD,
            'sum_aceptado_CLP' => $monthlySumsCLPaceptado,
            'sum_rechazado_CLP' => $monthlySumsCLPRechazado,
            'sum_en_curso_CLP' => $monthlySumsCLPcurso,
            'sum_aceptado_EUR' => $monthlySumsEURaceptado,
            'sum_rechazado_EUR' => $monthlySumsEURrechazado,
            'sum_en_curso_EUR' => $monthlySumsEURcurso,
            'sum_aceptado_USD' => $monthlySumsUSDaceptado,
            'sum_rechazado_USD' => $monthlySumsUSDrechazado,
            'sum_en_curso_USD' => $monthlySumsUSDcurso,
        ];
        
      
    }

    return $data;
    
    }

     //// dashboard  panel RegistrosAnalisisEstados
    public function RegistrosAnalisisEstados()
    {
        $vendedor = (int) $this->vendedor;

    $this->totalRegistros = registrospagosagencias::selectRaw('
    COUNT(*) as total_registros,
    SUM(CASE WHEN estado = "en curso" THEN 1 ELSE 0 END) as registros_en_curso,
    SUM(CASE WHEN estado = "rechazado" THEN 1 ELSE 0 END) as registros_rechazados
')
->whereYear('created_at', $this->Year)
->when(($this->vendedor != 0), function ($query) use ($vendedor) {
    $query->where('id_vendedor', $vendedor);
})
->first();

    $this->registrosAceptados = registrospagosagencias::selectRaw('
    COUNT(*) as total_registros,
    SUM(CASE WHEN moneda = "CLP" THEN monto ELSE 0 END) as suma_monto_clp,
    SUM(CASE WHEN moneda = "EUR" THEN monto ELSE 0 END) as suma_monto_eur,
    SUM(CASE WHEN moneda = "USD" THEN monto ELSE 0 END) as suma_monto_usd
')
->whereYear('created_at', $this->Year)
->when(($this->vendedor != 0), function ($query) use ($vendedor) {
    $query->where('id_vendedor', $vendedor);
})
->where('estado', 'aceptado')
->first();

    }

       //////// actividad semanal

       public function Actividadsemanal()
       {

        // Obtén el timestamp del primer día de la semana en curso (asumiendo que la semana comienza el lunes)
$primerDiaSemana = strtotime('this week');

// Formatea la fecha como desees
$this->startDateOfWeek = date('Y-m-d', $primerDiaSemana);

// Obtén el timestamp del último día de la semana en curso (asumiendo que la semana comienza el lunes)
$ultimoDiaSemana = strtotime('this week +6 days');

// Formatea la fecha como desees
$this->endDateOfWeek = date('Y-m-d', $ultimoDiaSemana);



        $defaultResult = [
            'estado' => 'Total',
            'total_registros' => 0,
            'suma_monto' => 0,
            'suma_aceptado' => 0,
            'suma_en_curso' => 0,
            'suma_rechazado' => 0,
            'count_aceptado' => 0,
            'count_en_curso' => 0,
            'count_rechazado' => 0,
        ];
        
        $this->actividadSemanal = registrospagosagencias::selectRaw('
        "Total" as estado,
        COUNT(*) as total_registros,
        SUM(monto) as suma_monto,
        SUM(CASE WHEN estado = "aceptado" THEN monto ELSE 0 END) as suma_aceptado,
        SUM(CASE WHEN estado = "en curso" THEN monto ELSE 0 END) as suma_en_curso,
        SUM(CASE WHEN estado = "rechazado" THEN monto ELSE 0 END) as suma_rechazado,
        COUNT(CASE WHEN estado = "aceptado" THEN 1 END) as count_aceptado,
        COUNT(CASE WHEN estado = "en curso" THEN 1  END) as count_en_curso,
        COUNT(CASE WHEN estado = "rechazado" THEN 1  END) as count_rechazado
    ')
    ->whereBetween('created_at', [$this->startDateOfWeek, $this->endDateOfWeek])
    ->where('id_vendedor',(int) $this->vendedor)
    ->where('moneda',  $this->moneda )
    ->groupBy('estado') // Agrupamos por la columna ficticia "estado"
    ->first() ?: $defaultResult; 
 //SUM(CASE WHEN moneda ="'. $this->moneda .'" THEN monto ELSE 0 END) as suma_monto,

       /// se selecciona el nombre y apellido del vendedor para mostra al admin 
       $this->vendedorNom= vendedores::selectRaw('CONCAT(nombre, " ", apellido) as nombre_completo')
       ->where('id', (int) $this->vendedor)->first();
    
       //// obtener monedas que utiliza el pais ára recibir sus pagos

       $this->monedas =monedas::where('pais_id', auth()->user()->pais_id )->select('moneda')->get();
    

       }
///////metodo para obtener todo los vendedores 
    public function vendedores()
    {
       $this->vendedores = vendedores::where('pais_id', auth()->user()->pais_id )->get();
    }

    public function render()
    {
        $this->emit('reloadClassCSs');
        self::vendedores();
        self::RegistrosAnalisisEstados();
        self::Actividadsemanal();
        self::getYears();
       
       

        return view('livewire.panel-control');
    }
}

