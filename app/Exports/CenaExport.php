<?php

namespace App\Exports;

use App\Cena;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class CenaExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        

        return DB::table("cenas")
        	->Join('users', 'cenas.user_id', '=', 'users.id')
            ->Join('menu_cenas', 'cenas.menucena_id', '=', 'menu_cenas.id')->where('cenas.active','=','1')
            ->select('cenas.id', 'cenas.fechac', 'menu_cenas.nombrec','cenas.descriptionc','users.name', 'users.fname')
            ->get();
    }

     public function headings(): array
    {
        return [
           'ID',
			'Fecha',
			'Menu Cena',
			'Descripcion Cena',
			'Nombre ',
			'Apellido ',
			

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
