<?php

namespace App\Exports;

use App\Permission\Models\Almuerzo;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;



class AlmuerzoExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents	
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()                
    {
    	
        return DB::table("almuerzos")
        	->leftJoin('users', 'almuerzos.user_id', '=', 'users.id')
            ->leftJoin('visitas', 'almuerzos.visit_id', '=', 'visitas.id')
            ->leftJoin('menu_almuerzos', 'almuerzos.malmuerzo_id', '=', 'menu_almuerzos.id')->where('almuerzos.active','=','1')
            ->select('almuerzos.id', 'almuerzos.fecha', 'menu_almuerzos.nombre','almuerzos.description','users.name', 'users.fname','visitas.namev', 'visitas.lastname')
            ->get();
            
    }

     public function headings(): array
    {
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
