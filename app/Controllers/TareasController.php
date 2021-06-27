<?php
namespace App\Controllers;
use App\Models\TareasModel;
class TareasController extends BaseController
{	public $db;
	public function __construct(){
		$this->db=\Config\Database::connect();
	}
	public function index()
	{   $TareasModel=new TareasModel;
			$fechaI=$this->request->getGetPost('FechaInicio');
			$fechaF=$this->request->getGetPost('FechaFin');
			$textbus=$this->request->getGetPost('textbus');
			$tipoTarea=$this->request->getGetPost('tipoTarea');
			$estado=$this->request->getGetPost('estado');
			$prioridad=$this->request->getGetPost('prioridad');
			$validada=$this->request->getGetPost('validada');
			if($this->request->getGetPost('buscar')){
				$listado=$TareasModel->get_tareasFiltros($fechaI,$fechaF,$textbus,$tipoTarea,$estado,$prioridad,$validada);
			}else{
				$listado=$TareasModel->get_tareas();
			}
        $data= array(
					'validada'=>$validada,
					'prioridad'=>$prioridad,
					'estado'=>$estado,
					'tipoTarea'=>$tipoTarea,
					'textbus'=>$textbus,
					'fechaF'=>$fechaF,
					'fechaI'=>$fechaI,
					'get_tareas'=>$listado,
					'get_tipoTarea'=>$TareasModel->get_tipoTarea(),
					'get_estadoTarea'=>$TareasModel->get_estadoTarea(),
					'get_prioridadTarea'=>$TareasModel->get_prioridadTarea(),
					);
		echo view('inicio/header');
		echo view('tareas/listadoTareas',$data);
		echo view('inicio/footer');
	}
	public function actualizarTarea(){
		$TareasModel=new TareasModel;
		$idTarea=$this->request->getPostGet("codTarea");
		$nAvance=$this->request->getPostGet("nAvance");
		$a="B";
		for ($i=0; $i < count($idTarea) ; $i++) {
			$id=$idTarea[$i];
			$avance=$nAvance[$i];
			//modificar el usuario
			$listado=$TareasModel->ActualizarTarea($id,$avance);
			$listado=$TareasModel->ActualizarAvanceSemaforo($id);
		
		}
		$a="A";
		echo($a);
		
	}
	public function get_TareasTable(){
		$valor_buscado=$this->request->getGetPost('search')['value'];
		$fechaI=$this->request->getGetPost('FechaInicio');
		$fechaF=$this->request->getGetPost('FechaFin');
		$textbus=$this->request->getGetPost('textbus');
		$tipoTarea=$this->request->getGetPost('tipoTarea');
		$estado=$this->request->getGetPost('estado');
		$prioridad=$this->request->getGetPost('prioridad');
		$validada=$this->request->getGetPost('validada');

		if($textbus !=''){
			$textbus=" AND TA.cTarea LIKE '%$textbus%'";
		  }if($fechaI !=''){
			$fechaI="AND Convert(DATE, dFecIni)='$fechaI' ";
		  }if($fechaF !=''){
			$fechaF="AND Convert(DATE, dFecFin)='$fechaF' ";
		  }if($tipoTarea !=''){
			$tipoTarea="AND TA.nCodProy='$tipoTarea' ";
		  }if($estado !=''){
			$estado="AND TA.nCodEst='$estado' ";
		  }if($prioridad !=''){
			$prioridad="AND TA.nCodPri='$prioridad' ";
		  }if($validada !=''){
			if($validada =='NULL'){
			  $validada="AND TA.bValidada is null ";
			}else{
			  $validada="AND TA.bValidada='$validada' ";
			}
			
		  }
		$table_map=[
			0 =>'TA.cTarea',
			1 =>'AR.Descripcion',
			2 =>'PR.cProyecto',
			3 =>'EM.cNombres',
			4 =>'TA.dFecIni',
			5 =>'Ta.dFecFin',
			6 =>'PRI.cPrioridad',
			7 =>'ES.cEstado',
			8 =>'TA.nAvanCalDia',
			9 =>'Ta.bValidada',
		];
		$table_map2=[
			0 =>'TA.cTarea',
			1 =>'AR.Descripcion',
			2 =>'PR.cProyecto',
			3 =>'EM.cNombres',
			4 =>'TA.dFecIni',
			5 =>'Ta.dFecFin',
			6 =>'PRI.cPrioridad',
			7 =>'ES.cEstado',
			8 =>'TA.nAvanCalDia',
			9 =>'Ta.bValidada',
			10 =>'EM.cApePat',
			11 =>'EM.cApeMat',
		];
		
		$sql_count="select count(nCodTar) as total from  GT_Tareas AS TA INNER JOIN VW_GRAREAS AS AR ON TA.nCodArea=AR.Codigo INNER JOIN GT_Proyecto AS PR ON TA.nCodProy=PR.nCodProy inner JOIN GT_Empleado AS EM ON TA.cCodEmpResp=EM.cCodEmp INNER JOIN GT_Prioridad AS PRI ON TA.nCodPri=PRI.nCodPri INNER JOIN GT_Estado AS ES ON TA.nCodEst=ES.nCodEst where 1=1 $textbus $fechaI $fechaF $tipoTarea $estado $prioridad $validada";
		$sql_data=" select ES.nCodEst as nCodEst ,TA.nCodTar as nCodTar,TA.cTarea as Tarea,PR.cProyecto AS Tipo,AR.Descripcion AS Area,EM.cApePat+' '+EM.cApeMat+' '+ EM.cNombres AS Responsable ,Convert(DATE, dFecIni) as Inicio ,Convert(DATE, dFecFin) as Fin,PRI.cPrioridad AS Prioridad,ES.cEstado AS Estado ,TA.nAvance as Av,Ta.bValidada as V from  GT_Tareas AS TA INNER JOIN VW_GRAREAS AS AR ON TA.nCodArea=AR.Codigo INNER JOIN GT_Proyecto AS PR ON TA.nCodProy=PR.nCodProy inner JOIN GT_Empleado AS EM ON TA.cCodEmpResp=EM.cCodEmp INNER JOIN GT_Prioridad AS PRI ON TA.nCodPri=PRI.nCodPri INNER JOIN GT_Estado AS ES ON TA.nCodEst=ES.nCodEst where 1=1 $textbus $fechaI $fechaF $tipoTarea $estado $prioridad $validada";
		$condition="";
		if(!empty($valor_buscado)){
			foreach($table_map2 as $key =>$val){
				if($table_map2[$key] == 'TA.cTarea'){
					$condition .= " WHERE ". $val ." LIKE '%".$valor_buscado."%'";
				}else{
					$condition .= " OR " . $val ." LIKE '%".$valor_buscado."%'";
				}
			}
		}else{
			print_r($valor_buscado);
		}
		$sql_count=$sql_count.$condition;
		$sql_data=$sql_data.$condition;
		
		$total_count=$this->db->query($sql_count)->getRow();
		
		$sql_data .=" order by ".$table_map[$this->request->getGetPost('order')[0]['column']]." ".$this->request->getGetPost('order')[0]['dir']." OFFSET ".$this->request->getGetPost('start') ." ROWS FETCH NEXT ".$this->request->getGetPost('length')." ROWS ONLY";
		$data=$this->db->query($sql_data)->getResult();
		$json_data=[
			'draw'=>intval($this->request->getGetPost('draw')),
			'recordsTotal'=>$total_count->total,
			'recordsFiltered'=>$total_count->total,
			'data'=>$data
		];
		echo json_encode($json_data);
	}
}

