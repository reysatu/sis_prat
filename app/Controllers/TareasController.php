<?php
namespace App\Controllers;
use App\Models\TareasModel;
class TareasController extends BaseController
{
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
		
	}
}

