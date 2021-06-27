<?php
namespace App\Controllers;
use App\Models\CuadroMandoModel;
class CuadroMandoController extends BaseController
{
	public function index()
	{	$mesS = array("base","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Obtubre","Noviembre","Diciembre");
		$CuadroMandoModel=new CuadroMandoModel;
		$Anio2=$this->request->getGetPost('anio');
		$cuadro=$this->request->getGetPost('cuadro');
		$mes=$this->request->getGetPost('mes');
		$indice=$mes;
		if($mes==""){
			$indice=0;
		}
		if($this->request->getGetPost('buscar')){
			$ListadoCualitativas=$CuadroMandoModel->get_ListadoCualitativas($Anio2,$cuadro,$mes);
			$listadoCuantitativo=$CuadroMandoModel->get_ListadoCuantitativas($Anio2,$cuadro,$mes);
		}else{
			$ListadoCualitativas=$CuadroMandoModel->ListadoCualitativas();
			$listadoCuantitativo=$CuadroMandoModel->ListadoCuantitativas();
		}
		
		$data= array(
					'messele'=>$mesS[$indice],
					'Anio2'=>$Anio2,
					'cuadro'=>$cuadro,
					'mes'=>$mes,
					'Anio'=>$CuadroMandoModel->get_Anio(),
					 'CuadroMando'=>$CuadroMandoModel->get_CuadroMando(),
					 'ListadoCuantitativas'=>$listadoCuantitativo,
					 'ListadoCualitativas'=>$ListadoCualitativas);
		echo view('inicio/header');
		echo view('cuadro/listadoNum',$data);
		echo view('inicio/footer');
	}
	public function actualizarCuadro(){
		$CuadroMandoModel=new CuadroMandoModel;
		$id_cuant=$this->request->getPostGet("id_cuant");
		$value_cuant=$this->request->getPostGet("value_cuant");
		$mes_cuant=$this->request->getPostGet("mes_cuant");

		$id_cualit=$this->request->getPostGet("id_cualit");
		$value_cualit=$this->request->getPostGet("value_cualit");
		$mes_cualit=$this->request->getPostGet("mes_cualit");

		$totales=$this->request->getPostGet("values_static_total");
		$idv=$this->request->getPostGet("idvariables");
		if($id_cuant!=null){
			for ($i=0; $i < count($id_cuant) ; $i++) {
				if($mes_cuant[$i]!="13"){
					$idVariable=$id_cuant[$i];
					$iMes=$mes_cuant[$i];
					$nValor=$value_cuant[$i];
					//modificar el usuario
					$CuadroMandoModel->ActualizarCuadro($idVariable,$iMes,$nValor);
				}
			
			}
			
			for ($i=0; $i < count($idv) ; $i++) {
					$idVariable=$idv[$i];
					$iMes="13";
					$nValor=$totales[$i];
					//modificar el usuario
					$CuadroMandoModel->ActualizarCuadro($idVariable,$iMes,$nValor);
			
			}
			
		}if($id_cualit!=null){
			for ($i=0; $i < count($id_cualit) ; $i++) {
				if($mes_cualit[$i]!="13"){
					$idVariable=$id_cualit[$i];
					$iMes=$mes_cualit[$i];
					$cValor=$value_cualit[$i];
					
					//modificar el usuario
					$CuadroMandoModel->ActualizarCuadroCual($idVariable,$iMes,$cValor);
				}
			
			}

		}
		
	
		echo("A");
		
	}
}
