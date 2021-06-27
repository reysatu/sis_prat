<?php
namespace App\Controllers;
use App\Models\RevisionVehicularModel;
use App\Models\RevicionModel2;
use App\Models\RevisionDetalleModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Mpdf\Mpdf;
class ReporteRevisionVehicular extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
    public function printPDF($id){
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        $RevisionVehicularModel=new RevisionVehicularModel;
        $datosrv=$RevisionVehicularModel->get_datosselect($id);
        $feha_selec=$datosrv->Fecha;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $numR = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
        $fechaComoEntero = strtotime($feha_selec);
        $mes = intval(date("m",$fechaComoEntero)) ;
        $mes= $meses[$mes-1];
        $data= array('getEmpresa' =>$RevisionVehicularModel->get_empresa(),
                     'datosrv'=>$RevisionVehicularModel->get_datosselect($id),
                    'mes'=>$mes,
                    'datosDet'=>$RevisionVehicularModel->get_datosselectDetalle($id));
        return view('report/report_RevisioVehicular',$data);
    }
    public function exportexcelRV($id){
         setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        $RevisionVehicularModel=new RevisionVehicularModel;
        $getEmpresa=$RevisionVehicularModel->get_empresa();
        $datosrv=$RevisionVehicularModel->get_datosselect($id);
        $datosDet=$RevisionVehicularModel->get_datosselectDetalle($id);
        $feha_selec=$datosrv->Fecha;
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $numR = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
        $fechaComoEntero = strtotime($feha_selec);
        $mes = intval(date("m",$fechaComoEntero)) ;
        $mes= $meses[$mes-1];
        $documento = new Spreadsheet();
        $documento->getProperties()->setCreator("Aquí va el creador, como cadena")											->setLastModifiedBy('Parzibyte') // última vez modificado por
        ->setTitle('Mi primer documento creado con PhpSpreadSheet')
        ->setSubject('El asunto')
        ->setDescription('Este documento fue generado para parzibyte.me')
        ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categoría');
        $hoja = $documento->getActiveSheet()->setShowGridlines(false);
        $drawing= new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName("logo");
        $drawing->setPath("logo_empresa.png");
        $drawing->setHeight(50);
        $drawing->setOffsetX(30);
        $drawing->setOffsetY(8);
        $drawing->setCoordinates("B2");	
        $drawing->setWorkSheet($hoja);
        $hoja->getRowDimension("1")->setRowHeight(10);
        $hoja->getRowDimension("5")->setRowHeight(8);
        $hoja->getRowDimension("6")->setRowHeight(12);
        $hoja->getRowDimension("8")->setRowHeight(12);
        $hoja->getRowDimension("12")->setRowHeight(12);
        $hoja->getRowDimension("15")->setRowHeight(12);
        $hoja->getRowDimension("13")->setRowHeight(12);
        $hoja->getRowDimension("14")->setRowHeight(10);
        $hoja->getRowDimension("9")->setRowHeight(6);
        $hoja->getRowDimension("7")->setRowHeight(25);
        $hoja->getRowDimension("11")->setRowHeight(6);
        $hoja->getColumnDimension("A")->setWidth(2);
        $hoja->getColumnDimension("B")->setWidth(10);
        $hoja->getColumnDimension("C")->setWidth(11);
        $hoja->getColumnDimension("M")->setWidth(5);
        $hoja->getColumnDimension("N")->setWidth(5);
        $hoja->getColumnDimension("O")->setWidth(5);
        $hoja->getColumnDimension("P")->setWidth(6);
        $hoja->getColumnDimension("Q")->setWidth(6);
        $hoja->getColumnDimension("R")->setWidth(6);
        $hoja->getColumnDimension("D")->setWidth(9);
        $hoja->getColumnDimension("E")->setWidth(9);
        $hoja->getColumnDimension("F")->setWidth(9);
        $hoja->getColumnDimension("G")->setWidth(8);
        $hoja->getColumnDimension("H")->setWidth(8);
        $hoja->getColumnDimension("I")->setWidth(8);
        $hoja->getColumnDimension("J")->setWidth(8);
        $hoja->getColumnDimension("K")->setWidth(8);
        $hoja->getColumnDimension("L")->setWidth(8);
        $hoja->mergeCells("B2:C4");
        $hoja->mergeCells("D2:L2");
        $hoja->mergeCells("D3:L4");
        $hoja->mergeCells("M2:O2");
        $hoja->mergeCells("M3:O3");
        $hoja->mergeCells("M4:O4");
        $hoja->mergeCells("P2:R2");
        $hoja->mergeCells("P3:R3");
        $hoja->mergeCells("P4:R4");
        $hoja->mergeCells("B6:C6");
        $hoja->mergeCells("B7:C7");
        $hoja->mergeCells("B8:C8");
        $hoja->mergeCells("D6:L6");
        $hoja->mergeCells("D7:L7");
        $hoja->mergeCells("D8:L8");
        $hoja->mergeCells("M6:O6");
        $hoja->mergeCells("M7:O8");
        $hoja->mergeCells("P6:R6");
        $hoja->mergeCells("P7:R8");
        $hoja->mergeCells("B12:C12");
        $hoja->mergeCells("B13:C13");
        $hoja->mergeCells("D12:F12");
        $hoja->mergeCells("D13:F13");
        $hoja->mergeCells("G12:I12");
        $hoja->mergeCells("G13:I13");
        $hoja->mergeCells("J12:R12");
        $hoja->mergeCells("J13:R13");
        $hoja->mergeCells("D10:M10");

        $hoja->mergeCells("B15:F15");
        $hoja->mergeCells("G15:J15");
        $hoja->mergeCells("K15:R15");

        $hoja->getStyle('A3')->getFont()->setSize(12);
        $hoja->getStyle('D6:L8')->getFont()->setSize(10);
        $hoja->getStyle('P2:R4')->getFont()->setSize(10);
        $hoja->getStyle('M2:O4')->getFont()->setSize(8);
     
        $hoja->setTitle("FRONTAL");
        $styleArray=[
            'borders'=>[
                'allBorders'=>[
                    'borderStyle'=>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color'=>['rgb'=>'000000'],
                ]
                
            ]
        ];
        $hoja2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($documento, 'Reverso');
        $hoja2->setCellValue("A1","REGISTRO DE OBSERVACIONES POR PARTE DEL CHOFER DE TRANSPORTE EN LA FECHA: $datosrv->Fecha ");
        $hoja2->setCellValue("A2","Observaciones Adicionales: ");
        $hoja2->setCellValue("A15"," ______________________	");
        $hoja2->setCellValue("A16"," Supervisor de la Flota	");
        $hoja2->setCellValue("A3",$datosrv->observaciones);
        
        $hoja->getRowDimension("2")->setRowHeight(28);
        $hoja2->mergeCells("A9:A14");
        $hoja2->mergeCells("A3:H3");
        $hoja2->mergeCells("A4:H4");
        $hoja2->mergeCells("A5:H5");
        $hoja2->mergeCells("A6:H6");
        $hoja2->mergeCells("A7:H7");
        $hoja2->mergeCells("A8:H8");
        
      

        $hoja2->setShowGridlines(false); 
        $documento->addSheet($hoja2, 1);
        $hoja2->getStyle('A3:H8')->applyFromArray($styleArray);
        $hoja2->getStyle('A1:J20')->getFont()->setBold(true);
        $contado=0; 
        $num=5;
        $fila=14;
        $a1=0;
        $a2=0;
        $a3=0;
        $a4=0;
        $a5=0; 
        foreach($datosDet as $row){
            $fila=$fila+1;
            $grupo=$row->cGrupo; 
            // if($grupo=="ACCESORIOS"){
                if($a1==0){
                    $valorgrup=$grupo;
                    $numi= $numR[$num-1];
                    $hoja->mergeCells("B$fila:F$fila");
                    $hoja->mergeCells("G$fila:J$fila");
                    $hoja->mergeCells("K$fila:R$fila");
                    $hoja->getStyle("B$fila:R$fila")->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setBold(true);
                    $hoja->getStyle("B$fila:R$fila")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000'); 
                    $hoja->getStyle("D$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hoja->setCellValue("B$fila","$numi. $row->cGrupo");
                    $hoja->setCellValue("G$fila","Acción");
                    $hoja->setCellValue("K$fila","Acción Correctiva");
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(10);
                    $hoja->getRowDimension($fila)->setRowHeight(14);
                    $fila=$fila+1;
                    $hoja->setCellValue("B".$fila,$row->cRevision);
                    $hoja->setCellValue("G".$fila,$row->cCodAccionR);
                    $hoja->setCellValue("K".$fila,$row->cAccionCorr);
                    $hoja->mergeCells("B$fila:F$fila");
                    $hoja->mergeCells("K$fila:R$fila");
                    $hoja->mergeCells("G$fila:J$fila");
                    $hoja->getStyle("K".$fila)->getAlignment()->setWrapText(true);
                    $hoja->getStyle("G$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
                    $hoja->getStyle('B'.$fila)->getFont()->setSize(10);
                    $hoja->getStyle('G'.$fila)->getFont()->setSize(8);
                    $hoja->getStyle('K'.$fila)->getFont()->setSize(7);
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(10);
                    $hoja->getRowDimension($fila)->setRowHeight(14);
                    $a1=$a1+1;
                    $num=$num+1;
               }else{
                if($valorgrup!=$grupo){
                    $valorgrup=$grupo;
                    $numi= $numR[$num-1];
                    $hoja->mergeCells("B$fila:F$fila");
                    $hoja->mergeCells("G$fila:J$fila");
                    $hoja->mergeCells("K$fila:R$fila");
                    $hoja->getStyle("B$fila:R$fila")->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setBold(true);
                    $hoja->getStyle("B$fila:R$fila")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000'); 
                    $hoja->getStyle("D$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hoja->setCellValue("B$fila","$numi. $row->cGrupo");
                    $hoja->setCellValue("G$fila","Acción");
                    $hoja->setCellValue("K$fila","Acción Correctiva");
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(10);
                    $hoja->getRowDimension($fila)->setRowHeight(14);
                    
                    $fila=$fila+1;
                    $hoja->setCellValue("B".$fila,$row->cRevision);
                    $hoja->setCellValue("G".$fila,$row->cCodAccionR);
                    $hoja->setCellValue("K".$fila,$row->cAccionCorr);
                    $hoja->mergeCells("B$fila:F$fila");
                    $hoja->mergeCells("K$fila:R$fila");
                    $hoja->mergeCells("G$fila:J$fila");
                    $hoja->getStyle("K".$fila)->getAlignment()->setWrapText(true);
                    $hoja->getStyle("G$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
                    $hoja->getStyle('B'.$fila)->getFont()->setSize(10);
                    $hoja->getStyle('G'.$fila)->getFont()->setSize(8);
                    $hoja->getStyle('K'.$fila)->getFont()->setSize(7);
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(10);
                    $hoja->getRowDimension($fila)->setRowHeight(14);
                    $a1=$a1+1;
                    $num=$num+1;
                }else{
                    $hoja->setCellValue("B".$fila,$row->cRevision);
                    $hoja->setCellValue("G".$fila,$row->cCodAccionR);
                    $hoja->setCellValue("K".$fila,$row->cAccionCorr);
                    $hoja->mergeCells("B$fila:F$fila");
                    $hoja->mergeCells("K$fila:R$fila");
                    $hoja->mergeCells("G$fila:J$fila");
                    $hoja->getStyle("K".$fila)->getAlignment()->setWrapText(true);
                    $hoja->getStyle("G$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
                    $hoja->getStyle('B'.$fila)->getFont()->setSize(10);
                    $hoja->getStyle('G'.$fila)->getFont()->setSize(8);
                    $hoja->getStyle('K'.$fila)->getFont()->setSize(7);
                    $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(10);
                    $hoja->getRowDimension($fila)->setRowHeight(14);
                    $a1=$a1+1;
                }
               
             
               }
        }
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:F$fila");
        $hoja->mergeCells("G$fila:R$fila");
        $hoja->getStyle("B$fila:R$fila")->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $hoja->getStyle("B$fila:R$fila")->getFont()->setBold(true);
        $hoja->getStyle("B$fila:R$fila")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000'); 
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->setCellValue("B$fila","Revisión");
        $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:F$fila");
        $hoja->mergeCells("G$fila:R$fila");
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->setCellValue("B$fila","Firma del Chofer de la unidad de transporte");
        $hoja->getRowDimension($fila)->setRowHeight(50);
        $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
    
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:F$fila");
        $hoja->mergeCells("G$fila:R$fila");
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->setCellValue("B$fila","V°B Jefe Inmediato");
        $hoja->getRowDimension($fila)->setRowHeight(50);
        $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:F$fila");
        $hoja->mergeCells("G$fila:R$fila");
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->setCellValue("B$fila","V°B Sup. SST");
        $hoja->getRowDimension($fila)->setRowHeight(50);
        $hoja->getStyle("B$fila:R$fila")->applyFromArray($styleArray);
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:R$fila");
      
        $hoja->setCellValue("B$fila","Leyenda : OK : Cumple  -  NO : No Cumple  -  F : Presencia de una falla - R : Reparado o Repuesto el accesorio");
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getFont()->setBold(true);
        $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(8);
        $hoja->getRowDimension($fila)->setRowHeight(10);
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:R$fila");
        
        $hoja->setCellValue("B$fila","(*) El llenado de este formato es obligación de cada usuario antes del inicio de sus actividades");
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(8);
        $hoja->getRowDimension($fila)->setRowHeight(10);
        $fila=$fila+1;
        $hoja->mergeCells("B$fila:R$fila");
        $hoja->setCellValue("B$fila","(*) Las observaciones  en la verificación del vehículo y al estar en ruta serán llenados en el reverso de éste registro");
        $hoja->getStyle("B$fila:R$fila")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle("B$fila:R$fila")->getFont()->setSize(8);
        $hoja->getRowDimension($fila)->setRowHeight(10);


        //-------------------------------------------------------------------
        $hoja->setCellValue("D2",$getEmpresa->TipoDoc);
        $hoja->setCellValue("D3",$getEmpresa->Documento);
        $hoja->setCellValue("M2","Código");
        $hoja->setCellValue("P3",$getEmpresa->Version);
        $hoja->setCellValue("M3","VERSIÓN");
        $hoja->setCellValue("M4","FECHA");
        $hoja->setCellValue("B6","RAZÓN SOCIAL");
        $hoja->setCellValue("B8","DIRECCIÓN");
        $hoja->setCellValue("B7","TIPO DE ACTIVIDAD \nECONÓMICA:");
        $hoja->setCellValue("M6","RUC");
        $hoja->setCellValue("B12","I. PLACA DEL VEHÍCULO");
        $hoja->setCellValue("B13","II.TIPO DE UNIDAD");
        $hoja->setCellValue("G12","III. MES");
        $hoja->setCellValue("G13","IV.TRANSPORTISTA");
        $hoja->setCellValue("M7","N° DE \nTRABAJADORES");
        $hoja->setCellValue("D10","FECHA: $datosrv->Fecha  REVISIÓN:  $datosrv->codAccion ");
        $hoja->setCellValue("P2",$getEmpresa->CodDocumento);
        $hoja->setCellValue("P2","DSM-PO-DIT-FO-14");
        $hoja->setCellValue("D12",$datosrv->Placa);
        $hoja->setCellValue("D13",$datosrv->Unidad_veh);
        $hoja->setCellValue("P4",$getEmpresa->FechaVersion);
        $hoja->setCellValue("P6",$getEmpresa->RUC);
        $hoja->setCellValue("P7",$getEmpresa->Trabajadores);
        $hoja->setCellValue("D6",$getEmpresa->RazonSocial);
        $hoja->setCellValue("D7",$getEmpresa->Actividad);
        $hoja->setCellValue("D8",$getEmpresa->Direccion);
        $hoja->setCellValue("J12",$mes);
        $hoja->setCellValue("J13",$datosrv->Chofer);
        $hoja->getStyle('j12:j13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D12:D13')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D2:R4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D2:R4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $hoja->getStyle('D6:L8')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D6:L8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


        $hoja->getStyle('P7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('P7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('P6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D10:M10')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('M2:O4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('M7:O8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('M6:O6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('D3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('B7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('M7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('A3')->getFont()->setName("Arial");
        $hoja->getStyle('D2:L4')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $hoja->getStyle('B6:C8')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $hoja->getStyle('M6:O8')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $hoja->getStyle('B12:C13')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $hoja->getStyle('G12:I13')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $hoja->getStyle('D2:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000');
        $hoja->getStyle('B6:C8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000');
        $hoja->getStyle('M6:O8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000');
        $hoja->getStyle('B12:C13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000');
        $hoja->getStyle('G12:I13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('c00000');
        $hoja->getStyle('D2:L2')->getFont()->setBold(true);
        $hoja->getStyle('D3:L4')->getFont()->setBold(true);
        $hoja->getStyle('B12:I13')->getFont()->setBold(true);
        $hoja->getStyle('B6:C8')->getFont()->setBold(true);
        $hoja->getStyle('M6:O8')->getFont()->setBold(true);
        $hoja->getStyle('D10')->getFont()->setBold(true);
    
        $hoja->getStyle('B2:R4')->applyFromArray($styleArray);
        $hoja->getStyle('B6:R8')->applyFromArray($styleArray);
        $hoja->getStyle('B12:R13')->applyFromArray($styleArray);
        $hoja->getStyle('B15:R15')->applyFromArray($styleArray);
        $hoja->getStyle('B7')->getAlignment()->setWrapText(true);
        $hoja->getStyle('D7')->getAlignment()->setWrapText(true);
        $hoja->getStyle('M7')->getAlignment()->setWrapText(true);
        $nombreDelDocumento ="RevisionVehicular-$datosrv->Fecha.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($documento, 'Xlsx');
        $writer->save('php://output');
        exit;
        }
}
