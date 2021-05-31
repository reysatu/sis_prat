<?php
namespace App\Controllers;
use App\Models\RevisionVehicularModel;
use App\Models\RevicionModel2;
use App\Models\RevisionDetalleModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class RevisionVController extends BaseController
{	
	public $db;
	public function __construct(){
		$this->db=\Config\Database::connect();
	}
	public function index()
	{
		$RevisionVehicularModel=new RevisionVehicularModel;
			$fechaI=$this->request->getGetPost('FechaInicio');
			$fechaF=$this->request->getGetPost('FechaFin');
			$placa=$this->request->getGetPost('re_placa');
		if($this->request->getGetPost('buscar')){
			
			if($this->request->getGetPost('re_placa')){
				$placa=$this->request->getGetPost('re_placa');
				$listado=$RevisionVehicularModel->mostrar3($fechaI,$fechaF,$placa);
			}
			else{
				$listado=$RevisionVehicularModel->mostrar2($fechaI,$fechaF);
			}
		}else{
			$month_start = strtotime('first day of this month', time());
			$month_end = strtotime('last day of this month', time());
			$fechaI= date('Y-m-d', $month_start);
			$fechaF= date('Y-m-d', $month_end);
			$listado=$RevisionVehicularModel->mostrar($fechaI,$fechaF);
		
		};
		$data= array('RevisionVehicularArray' =>$listado,
					'get_placas'=>$RevisionVehicularModel->get_placas(),
					'fechaI'=>$fechaI,
					'fechaF'=>$fechaF,
					'placa'=>$placa);
		echo view('inicio/header');
		echo view('revision_vehicular/listado_RV',$data);
		echo view('inicio/footer');
	}
	public function CambiarEstado(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$fechaI=$this->request->getGetPost('Finicio');
		$fechaF=$this->request->getGetPost('Ffin');
		$listado=$RevisionVehicularModel->mostrar2($fechaI,$fechaF);
		$valida="T";
		foreach ($listado as $row){
			$nConsentido=$row->Nro;
			$datos=$RevisionVehicularModel->get_datosselectDetalle($nConsentido);
			foreach($datos as $row2){
				$cCodAccionR=$row2->cCodAccionR;
				if($cCodAccionR==null){
					$valida="F";
				}
			}

		}
		if($valida=="T"){
			foreach ($listado as $row){
				$nConsentido=$row->Nro;
				$RevisionVehicularModel->cambiar_estado($nConsentido);
			}
		}
		echo($valida);
	
	}
	public function addRevisionVehicular(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$data= array('infconsecutivo' =>$RevisionVehicularModel->get_infconsecutivo(),
					'get_placas'=>$RevisionVehicularModel->get_placas(),
					'get_chofer'=>$RevisionVehicularModel->get_chofer(),
					'get_supervisor'=>$RevisionVehicularModel->get_supervisor(),
					'get_tipoRevision'=>$RevisionVehicularModel->get_tipoRevision(),
					'get_GroupRevision'=>$RevisionVehicularModel->get_GroupRevision(),
					'acciones_revision'=>$RevisionVehicularModel->get_accionesRevision(),
					
					);
		echo view('inicio/header');
		echo view('revision_vehicular/add_RV',$data);
		echo view('inicio/footer');
	}
	public function editRevisionVehicular($id){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$get_placa=$RevisionVehicularModel->get_datosselect($id);
		$placa=$get_placa->Placa;
		$estadoCA=$RevisionVehicularModel->get_datosselect($id);
		$estadoBoton="";
		if($estadoCA->Estado=='0'){
			$estadoBoton="Disabled";
		}
		$data= array('infconsecutivo' =>$RevisionVehicularModel->get_infconsecutivo(),
					'get_placas'=>$RevisionVehicularModel->get_placas(),
					'get_chofer'=>$RevisionVehicularModel->get_chofer(),
					'get_supervisor'=>$RevisionVehicularModel->get_supervisor(),
					'get_tipoRevision'=>$RevisionVehicularModel->get_tipoRevision(),
					'get_GroupRevision'=>$RevisionVehicularModel->get_GroupRevision(),
					'acciones_revision'=>$RevisionVehicularModel->get_accionesRevision(),
					'datos_select'=>$RevisionVehicularModel->get_datosselect($id),
					'get_datosselectDetalle'=>$RevisionVehicularModel->get_datosselectDetalle($id),
					'get_ordenes'=>$RevisionVehicularModel->get_orden_servicio($placa),
					'estadoBoton'=>$estadoBoton,
					);
		echo view('inicio/header');
		echo view('revision_vehicular/edit_RV',$data);
		echo view('inicio/footer');
	}
	public function eliminarRevisionVehicular($id){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$RevisionVehicularModel->eliminar_rv($id);
		$RevisionVehicularModel->eliminar_rvDet($id);
		return redirect()->to(site_url("RevisionVController"));
	}
	public function get_chofer(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$placa=$this->request->getGetPost('placa');
		$fecha=$this->request->getGetPost('fecha');
		$result=$RevisionVehicularModel->validar_placa($placa,$fecha);
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo("N");
		}
		
	}
	public function get_tipo_revision(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$placa=$this->request->getGetPost('placa');
		$result=$RevisionVehicularModel->get_Tipo_Revision($placa);
		if(!empty($result)){
			echo json_encode($result);
		}else{
			echo("N");
		}
	}
	public function get_GroupRevision(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$tipoRevision=$this->request->getGetPost('tipoRevision');
		$result=$RevisionVehicularModel->get_GroupRevision2($tipoRevision);
		echo json_encode($result);

	}
	public function get_NroOrden(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$placa=$this->request->getGetPost('placa');
		$result=$RevisionVehicularModel->get_orden_servicio($placa);
		echo json_encode($result);
	}
	
	public function guardarRevisionVehicular(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$RevisionDetalleModel=new RevisionDetalleModel;
		$microtime = floatval(substr((string)microtime(), 1, 8));
        $rounded = round($microtime, 3);
		$showdate = date("Y-d-m H:i:s") . substr((string)$rounded, 1, strlen($rounded));
		$consecutivo=$RevisionVehicularModel->get_nconsecutivo();
		
		$cCodConsecutivo=$this->request->getPostGet("cCodConsecutivo");
		$cCodEmp=$this->request->getPostGet("red_Chofer");
		$cPlacaVeh=$this->request->getPostGet("red_placa");
		$dFecReg=$this->request->getPostGet("red_feReg");
		$dFecReg=date("Y-d-m", strtotime($dFecReg));
		$nCodTipRev=$this->request->getPostGet("red_tipoRevision");
		$cCodAccionM=$this->request->getPostGet("red_nRev");
		$cTipoAccionM="M";
		$cCodJefe=$this->request->getPostGet("red_jefe");
		$dFecVBJefe=$this->request->getPostGet("red_fechaJef");
		$dFecVBJefe=date("Y-d-m", strtotime($dFecVBJefe));
		$cCodSup=$this->request->getPostGet("red_supervisor");
		$dFecVBJSup=$dFecVBJefe;
		$cObservaciones=$this->request->getPostGet("red_observacion");
		if($cObservaciones==""){
			$cObservaciones=null;
		}
		$iEstado="1";
		$cIdUsuCre="YUNTAS";
		$dFecCre=$showdate;
		$cIdUsuMod="YUNTAS";
		$dFecMod=$showdate;
	
		// $RevicionModel2->insertar($cCodConsecutivo,$nConsecutivo,$cCodEmp,$cPlacaVeh,$dFecReg,$nCodTipRev,$cCodAccionM,$cTipoAccionM,$cCodJefe,$dFecVBJefe,$cCodSup,$dFecVBJSup,$cObservaciones,$iEstado,$cIdUsuCre,$dFecCre,$cIdUsuMod,$dFecMod);
		$RV_consecutivo=$this->request->getPostGet("RV_consecutivo");
		
		$valida="F"; 
		$dFecReg2=date("Y-d-m", strtotime($dFecReg));
		if($RV_consecutivo==''){
			if($cCodAccionM=="1RO"){
			
				$validaNum=$RevisionVehicularModel->validaNum($cPlacaVeh,$cCodAccionM,$dFecReg2);
				if($validaNum==false){
					$valida="T";	
				};
			}else{
				$validaNum=$RevisionVehicularModel->validaNum($cPlacaVeh,$cCodAccionM,$dFecReg2);
				if($validaNum==false){
					$valida="T";	
				}
				$cCodAccionMB='1RO';
				$validaNum=$RevisionVehicularModel->validaNum($cPlacaVeh,$cCodAccionMB,$dFecReg2);
				if($validaNum==false){
					$valida="D";	
				}

			};
		if($valida=="T"){
			$nConsecutivo=$consecutivo->nConsecutivo+1;
		$data=[
			"cCodConsecutivo"=>$cCodConsecutivo,
			"nConsecutivo"=>$nConsecutivo,
			"cCodEmp"=>$cCodEmp,
			"cPlacaVeh"=>$cPlacaVeh,
			"dFecReg"=>$dFecReg,
			"nCodTipRev"=>$nCodTipRev,
			"cCodAccionM"=>$cCodAccionM,
			"cTipoAccionM"=>$cTipoAccionM,
			"cCodJefe"=>$cCodJefe,
			"dFecVBJefe"=>$dFecVBJefe,
			"cCodSup"=>$cCodSup,
			"dFecVBJSup"=>$dFecVBJSup,
			"cObservaciones"=>$cObservaciones,
			"iEstado"=>$iEstado,
			"cIdUsuCre"=>$cIdUsuCre,
			"dFecCre"=>$dFecCre,
			"cIdUsuMod"=>$cIdUsuMod,
			"dFecMod"=>$dFecMod,
		];
		$RevisionVehicularModel->insert($data);
		$RevisionVehicularModel->actualizar_consecutivo($nConsecutivo);
		$result=$RevisionVehicularModel->get_GroupRevision2($nCodTipRev);
		foreach ($result as $row){
				$cCodConsecutivo="RVHT";
				$nConsecutivo=$nConsecutivo;
				$nCodTipRev=$nCodTipRev;
				$nCodRev2= $row->nCodRev;
				$nCodGrupoRev2= $row->nCodGrupoRev;
				$cCodAccionR2='';
				$cTipoAccionR='';
				$cAccionCorr2='';
				$bLevantada='';
				$cCodConsecutivoOS2='';
				$nConsecutivoOS2='';
				$cIdUsuCre='YUNTAS';
				$cIdUsuMod='YUNTAS';
				$dFecMod=$showdate;
				$dFecCre=$showdate;
				$RevisionDetalleModel->insertar_db($cCodConsecutivo,$nConsecutivo,$nCodTipRev,$nCodRev2,
				$nCodGrupoRev2,$cCodAccionR2,$cTipoAccionR,$cAccionCorr2,$bLevantada,
				$cCodConsecutivoOS2,$nConsecutivoOS2,$cIdUsuCre,$cIdUsuMod,$dFecMod,$dFecCre);
			}
		 echo json_encode ($nConsecutivo);
		}else{
			echo ($valida);
		}		
		
		}else{
			$nConsecutivo=$consecutivo->nConsecutivo;
			$RevisionVehicularModel->update_rv($cCodEmp,$cCodSup,$cCodJefe,$dFecVBJSup,$dFecVBJefe,$cObservaciones,$dFecReg,$RV_consecutivo);
			echo json_encode ($nConsecutivo);
		}
	}
	
	public function guardarReVehDet(){
		$request=\Config\Services::request();
		$RevisionDetalleModel=new RevisionDetalleModel;
		$microtime = floatval(substr((string)microtime(), 1, 8));
        $rounded = round($microtime, 3);
		$showdate = date("Y-d-m H:i:s") . substr((string)$rounded, 1, strlen($rounded));

		$cCodConsecutivo=$this->request->getPostGet("cCodConsecutivo");
		$nConsecutivo=$this->request->getPostGet("nConsecutivo");
		$nCodTipRev=$this->request->getPostGet("nCodTipRev");
		$nCodRev=$request->getPostGet("nCodRev");
		$nCodGrupoRev=$this->request->getPostGet("nCodGrupoRev");
		$cCodAccionR=$this->request->getPostGet("cCodAccionR");
		$cTipoAccionR="R";
		$cAccionCorr=$this->request->getPostGet("cAccionCorr");
		$bLevantada='';
		$cCodConsecutivoOS=$this->request->getPostGet("cCodConsecutivoOS");
		$nConsecutivoOS=$this->request->getPostGet("nConsecutivoOS");
		$cIdUsuCre='YUNTAS';
		$cIdUsuMod='YUNTAS';
		$dFecMod=$showdate;
		$dFecCre=$showdate;
		
		$RevisionDetalleModel->eliminar_dt($nConsecutivo);
		for ($i=0; $i < count($nCodRev) ; $i++) {
			$nCodRev2=$nCodRev[$i]; 
			$nCodGrupoRev2=$nCodGrupoRev[$i];
			$cCodAccionR2=$cCodAccionR[$i];
			if($cCodAccionR2==''){
				$cCodAccionR2='';
				$cTipoAccionR='';
				
			};
			// $cCodAccionR2='OK';
			
			if(empty($cAccionCorr[$i])){
				$cAccionCorr2='';
			}else{
				$cAccionCorr2=$cAccionCorr[$i];
			};
			$cCodConsecutivoOS2=$cCodConsecutivoOS[$i];
			$nConsecutivoOS2=$nConsecutivoOS[$i];
			
			$RevisionDetalleModel->insertar_db($cCodConsecutivo,$nConsecutivo,$nCodTipRev,$nCodRev2,
			$nCodGrupoRev2,$cCodAccionR2,$cTipoAccionR,$cAccionCorr2,$bLevantada,
			$cCodConsecutivoOS2,$nConsecutivoOS2,$cIdUsuCre,$cIdUsuMod,$dFecMod,$dFecCre);
}


}


}


