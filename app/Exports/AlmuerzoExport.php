<?php

namespace App\Exports;

use App\Permission\Models\Almuerzo;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use DB;



class AlmuerzoExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents	
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $fecha1, $fecha2;

     function __construct($fecha1, $fecha2, $campo1) {
            $this->fecha1 = $fecha1;
            $this->fecha2 = $fecha2;
            $this->param1 = $campo1;
     }       
    public function collection()                
    {

          switch($this->param1){
               case 0:
                return DB::table("almuerzos")
            ->leftJoin('users', 'almuerzos.user_id', '=', 'users.id')
            ->leftJoin('visitas', 'almuerzos.visit_id', '=', 'visitas.id')
            ->leftJoin('menu_almuerzos', 'almuerzos.malmuerzo_id', '=', 'menu_almuerzos.id')->where('almuerzos.active','=','1')->orderby('almuerzos.fecha','asc')
            ->select('almuerzos.id', 'almuerzos.fecha', 'menu_almuerzos.nombre','almuerzos.description','users.name', 'users.fname','visitas.namev', 'visitas.lastname')->whereBetween('almuerzos.fecha',[$this->fecha1, $this->fecha2])
            ->get();
               break;
              case 1:
                return DB::table("almuerzos")
            ->join('users', 'almuerzos.user_id', '=', 'users.id')
            ->Join('menu_almuerzos', 'almuerzos.malmuerzo_id', '=', 'menu_almuerzos.id')->where('almuerzos.active','=','1')->orderby('almuerzos.fecha','asc')
            ->select('almuerzos.id', 'almuerzos.fecha', 'menu_almuerzos.nombre','almuerzos.description','users.name', 'users.fname')->whereBetween('almuerzos.fecha',[$this->fecha1, $this->fecha2])
            ->get();
              
              break; 

              case 2:
                return DB::table("almuerzos")
            ->Join('visitas', 'almuerzos.visit_id', '=', 'visitas.id')
            ->Join('menu_almuerzos', 'almuerzos.malmuerzo_id', '=', 'menu_almuerzos.id')->where('almuerzos.active','=','1')->orderby('almuerzos.fecha','asc')
            ->select('almuerzos.id', 'almuerzos.fecha', 'menu_almuerzos.nombre','almuerzos.description','visitas.namev', 'visitas.lastname')->whereBetween('almuerzos.fecha',[$this->fecha1, $this->fecha2])
            ->get();

              break;

            default:


           }       
            
    }

     public function headings(): array
    {

      switch($this->param1){
        case 0:
        return [
           'ID',
			'Fecha',
			'Menu',
			'Descripcion',
			'Nombre (usuario)',
			'Apellido (usuario)',
			'Nombre (Visita)',
			'Apellido (Visita)',

        ];
        break;
        
        case 1:

          return [
           'ID',
            'Fecha',
            'Menu',
            'Descripcion',
            'Nombre (usuario)',
            'Apellido (usuario)',
       ];

        break; 

        case 2:

          return [
            'ID',
            'Fecha',
            'Menu',
            'Descripcion',
            'Nombre (Visita)',
            'Apellido (Visita)',
       ];

        break; 

        default:
      }
    }

    public function registerEvents(): array
    {
        return [
            
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:H1')->applyFromArray([
                 'font' => [
                    'bold' =>true
                 ]


                ]);

            },
        ];
    }

}
