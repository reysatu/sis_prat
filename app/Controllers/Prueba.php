<?php
namespace App\Controllers;
use App\Models\RevisionVehicularModel;
class Prueba extends BaseController
{	
	public $db;
	public function __construct(){
		$this->db=\Config\Database::connect();
	}
	public function index()
	{
	}
	public function get_revision(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$valor_buscado=$this->request->getGetPost('search')['value'];
		$table_map=[
			0 =>'nCodRev',
			1 =>'cCodConsecutivo',
		];
		$sql_count="select count(nCodRev) as total from GF_RevisionVehicularDet";
		// $sql_data="select Convert(DATE, dFecReg) as Fecha, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,am.cAccion as Revision,ch.Descripcion as Chofer, cs.Descripcion as Supervisor, cj.Descripcion as Jefe  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo";
		$sql_data="select * from  GF_RevisionVehicularDet";
		$condition="";
		if(!empty($valor_buscado)){
		
			foreach($table_map as $key =>$val){
				if($table_map[$key] == 'nCodRev'){
					$condition .= " WHERE ". $val ." LIKE '%". $valor_buscado . "%'";
				}else{
					$condition .= " OR " . $val ." LIKE '%". $valor_buscado . "%'";
				}
			}
		}else{
			print_r($valor_buscado);
		}
		$sql_count=$sql_count.$condition;
		$sql_data=$sql_data.$condition;
		$total_count=$this->db->query($sql_count)->getRow();
        // ORDER BY ".$table_map[$this->request->getGetPost('order')[0]['column']].  " OFFSET "."10"." ROWS FETCH NEXT " ."12 "." ROWS ONLY 

		
	
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
<?php
namespace App\Controllers;
use App\Models\RevisionVehicularModel;
class RevisionVControlller extends BaseController
{	
	public $db;
	public function __construct(){
		$this->db=\Config\Database::connect();
	}
	public function index()
	{
		$RevisionVehicularModel=new RevisionVehicularModel;
		$data= array('categoria' =>$RevisionVehicularModel->mostrar());
		echo view('inicio/header');
		echo view('revision_vehicular/listado_RV',$data);
		echo view('inicio/footer');
	}
	public function get_revision(){
		$RevisionVehicularModel=new RevisionVehicularModel;
		$valor_buscado=$this->request->getGetPost('search')['value'];
		$table_map=[
			
			0 =>'Fecha',
			1 =>'Placa',
			2 =>'Codigo',
			3 =>'Nro',
			4 =>'TipoRevision',
			5 =>'Revision',
			6 =>'Chofer',
			7 =>'Supervisor',
			8 =>'Jefe',
		];
		
		$sql_count="select count(nConsecutivo) as total from GF_RevisionVehicular";
		$sql_data="select Convert(DATE, dFecReg) as Fecha, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,am.cAccion as Revision,ch.Descripcion as Chofer, cs.Descripcion as Supervisor, cj.Descripcion as Jefe  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo";
		$condition="";
		if(!empty($valor_buscado)){
			foreach($table_map as $key =>$val){
				if($table_map[$key] == 'Nro'){
					$condition .= " WHERE ". $val ." LIKE '%". $valor_buscado . "%'";
				}else{
					$condition .= " OR " . $val ." LIKE '%". $valor_buscado . "%'";
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
	public function get_revision2(){
		$placa=$this->request->getGetPost('placa');
		$sql_count="select count(nConsecutivo) as total from GF_RevisionVehicular";
		$sql_data="select Convert(DATE, dFecReg) as Fecha, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,am.cAccion as Revision,ch.Descripcion as Chofer, cs.Descripcion as Supervisor, cj.Descripcion as Jefe  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo WHERE cPlacaVeh = '$placa'";
		$total_count=$this->db->query($sql_count)->getRow();
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

