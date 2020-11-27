<?php

namespace App\Exports;

use App\Permission\Models\Permits;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use DB;

class PermitsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents  
{
    /**
    * @return \Illuminate\Support\Collection
    */


     protected $fechainicio, $fechafinal;

     function __construct($fechainicio, $fechafinal) {
            $this->fechainicio = $fechainicio;
            $this->fechafinal = $fechafinal;
           
     }       

    public function collection()
    {
        
           return DB::table("permits")
        ->leftJoin('users as tbl1', 'permits.user_id', '=', 'tbl1.id')
        ->leftJoin('users as tbl2', 'permits.useraproval_id', '=', 'tbl2.id')
        ->leftJoin('permits_types', 'permits.permittype_id', '=', 'permits_types.id')
        ->leftJoin('permits_statuses', 'permits.permitstatus_id', '=', 'permits_statuses.id')->orderBy('permits.fechainicio', 'asc')
        ->select('permits.id', 'permits.fechainicio','permits.fechafinal','permits.horainicio','permits.horafinal','tbl1.name','tbl1.fname','permits_types.nombrept','permits.description','permits_statuses.namep','tbl2.name as nombre','tbl2.fname as apellido','permits.sede','permits.active','permits.created_at')->whereBetween('permits.fechainicio',[$this->fechainicio, $this->fechafinal])
        ->get();
    }

     public function headings(): array
    {
        return [
           'ID',
                'Fecha inicio',
                'Fecha final',
                'Hora  inicio',
                'Hora  final',
                'Nombre (Agente)',
                'Apellido (Agente)',
                'Tipo',
                'Descripcion',
                'Estado',
                'Nombre (Aprueba)',
                'Apellido (Aprueba)',
                'Sede',
                'Active',
                'Fecha de registro'

        ];
   }

     public function registerEvents(): array
    {
        return [
            
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:O1')->applyFromArray([
                 'font' => [
                    'bold' =>true
                 ]


                ]);

            },
        ];
    }
}
