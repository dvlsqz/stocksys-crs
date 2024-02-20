<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

use App\Models\RutaSolicitud, App\Models\Bodega, App\Models\Solicitud;
use Illuminate\Support\Facades\Http;
use DB, Carbon\Carbon,  Auth;

class GuiaTerrestreExport implements FromView, WithEvents, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public $idSolicitud;
    public $services_siigss;
    public $datos;
    public $servicios;

    function __construct($data){
        
        $this->idSolicitud = $data['idSolicitud'];
        $this->idRuta = $data['idRuta'];
    }



    public function view(): View{
        

        $data = [
            
        ];

        return view('admin.reportes.vistas.informe_mensual', $data);
    }

    public function title(): string
    {   
        //return 'Día '.Carbon::now()->format('d');
        return 'Informe mensual - '.Carbon::now()->year;
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class    => function(AfterSheet $event){
                

                $event->sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
                $event->sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getPageSetup()->setFitToPage(true);
                //$event->sheet->setShowGridlines(False);

                $event->sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        
                // lock all cells then unlock the cell
                $event->sheet->getParent()->getActiveSheet()
                    ->getStyle('J3:P6')
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_UNPROTECTED);

                
                $event->sheet->mergeCells('E1:P1');        
                $event->sheet->getStyle('E1:P1')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('E1', 'Programa "Aprendizaje para la vida" "Nojb\'al rech K\'aslemal" (K\'iche)');
                $event->sheet->getStyle('E1')->getFont()->setBold(true);
                $event->sheet->mergeCells('E2:P2');        
                $event->sheet->getStyle('E2:P2')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('E2', 'Pastoral Social Cáritas de los Altos ');
                $event->sheet->getStyle('E2')->getFont()->setBold(true);

                $event->sheet->mergeCells('A4:G4');        
                $event->sheet->setCellValue('A4', 'Arquidiocesis de los Altos Quetzaltenango Totonicapán');                
                $event->sheet->mergeCells('A5:G5');        
                $event->sheet->setCellValue('A5', 'Bodega PSC Salcajá #12');
                $event->sheet->mergeCells('A6:G6');        
                $event->sheet->setCellValue('A6', 'KM. 190 Autopista Los Altos, Salcajá Quetzaltenango');
                $event->sheet->mergeCells('A7:G7');        
                $event->sheet->setCellValue('A7', 'Teléfono: 77688109');
                $event->sheet->getStyle('A4:G7')->getFont()->setBold(true);
                
                
                $event->sheet->mergeCells('A10:B10');        
                $event->sheet->setCellValue('A10', 'Fecha de traslado:');
                $event->sheet->getStyle('A10')->getFont()->setBold(true);

                $event->sheet->mergeCells('M10:P10');        
                $event->sheet->setCellValue('M10', 'Periodo correspondiente:');
                $event->sheet->getStyle('M10')->getFont()->setBold(true);
                /*---------------------------------------------------------------------------------------------------------------------*/   
                $event->sheet->mergeCells('A12:T12');        
                $event->sheet->getStyle('A12:T12')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('A12', 'GUIA DE TRANSPORTE TERRESTRE');
                $event->sheet->getStyle('A12')->getFont()->setBold(true);
                $event->sheet->getStyle('A12:T12')->getBorders()->getOutline()->setBorderStyle(Border::BORDER_MEDIUM);
                /*---------------------------------------------------------------------------------------------------------------------*/
                $event->sheet->mergeCells('A14:C14');        
                $event->sheet->setCellValue('A14', 'Ruta:');                
                $event->sheet->mergeCells('A15:C15');        
                $event->sheet->setCellValue('A15', 'Empresa del Transporte:');
                $event->sheet->mergeCells('A16:C16');        
                $event->sheet->setCellValue('A16', 'Nombre del Piloto:');
                $event->sheet->mergeCells('A17:C17');        
                $event->sheet->setCellValue('A17', 'Número de licencia:');
                $event->sheet->getStyle('A14:C17')->getFont()->setBold(true);

                $event->sheet->mergeCells('M14:O14');        
                $event->sheet->setCellValue('M14', 'Dirección de Emisión:');                
                $event->sheet->mergeCells('M15:O15');        
                $event->sheet->setCellValue('M15', 'Municipio de Destino:');
                $event->sheet->mergeCells('M16:O16');        
                $event->sheet->setCellValue('M16', 'Placa del Vehículo:');
                $event->sheet->mergeCells('M17:O17');        
                $event->sheet->setCellValue('M17', 'Tipo de Vehículo:');
                $event->sheet->getStyle('M14:O17')->getFont()->setBold(true);
                /*---------------------------------------------------------------------------------------------------------------------*/
                $event->sheet->mergeCells('A19:T20'); 
                $event->sheet->setCellValue('A19', 'NOTA: El encargado del transporte se responsabiliza por daños o diferencias en las unidades o cantidades que no sean entregadas en la bodega de destino, por diferencia de esta guía.');
                /*---------------------------------------------------------------------------------------------------------------------*/
                $event->sheet->mergeCells('A22:B22');        
                $event->sheet->setCellValue('A22', 'CODIGO');
                $event->sheet->mergeCells('C22:D22');        
                $event->sheet->setCellValue('C22', 'ESCUELA');
                $event->sheet->mergeCells('E22:F22');        
                $event->sheet->setCellValue('E22', 'Part.');

                $columnas = ['G','I','J','K','L','M','N','O','P','Q'];
                $cantidad_alimentos = Bodega::where('categoria', 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->count();
                $alimentos = Bodega::where('categoria', 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();

                $prueba = ['G','H','I','J','K'];
                $row = 1;
                $d = 0;
                for($i =0; $i < count($prueba); $i++){
                    for($f = 0; $f < $cantidad_alimentos; $f++){
                        $event->sheet->setCellValue($prueba[$i].'22', $alimentos[$d]->nombre);
                    }
                    $d++;
                }


                

                
            },
        ];
    }

}
