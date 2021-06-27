<?php namespace App\Models;
use CodeIgniter\Model;
class CuadroMandoModel extends Model{ 
    function ActualizarTarea($id,$avance){
      $db=db_connect();
      $mostrar=$db->query(
      "update GT_Tareas set nAvance='$avance',
      cIdUsuMod='BRAYAM', dFecMod = GETDATE() where nCodTar='$id';
    ");
      return $mostrar->getResult();
    }
    function get_Anio(){
        $mostrar=$this->db->query("select DISTINCT YEAR( dFecCre) as Anio from  CM_Variables");
        return $mostrar->getResult(); 
    }
    function get_CuadroMando(){
        $mostrar=$this->db->query("select * from CM_CuadroMando");
        return $mostrar->getResult(); 
    }
    function ListadoCuantitativas(){
        $mostrar=$this->db->query(" select * from CM_Variables as CV INNER JOIN CM_CuadroMandoVariablesDetalle AS CDT ON CDT.idVariable=CV.idVariable WHERE CV.cTipo='Q' AND CV.iTipo != 0");
        return $mostrar->getResult(); 
    }
    function ListadoCualitativas(){
      $mostrar=$this->db->query(" select * from CM_Variables as CV INNER JOIN CM_CuadroMandoVariablesDetalle AS CDT ON CDT.idVariable=CV.idVariable WHERE CV.cTipo='C' AND CV.iTipo != 0");
        return $mostrar->getResult(); 
    }
    function get_ListadoCuantitativas($anio,$cuadro,$mes){
      if($anio !=''){
        $anio=" AND YEAR(cv.dFecCre)='$anio'";
      }if($cuadro !=''){
        $cuadro=" and CDT.iCuadro='$cuadro'";
      }if($mes !=''){
        $mes=" AND (CDT.iMes='$mes' OR CDT.iMes='13') ";
      }
      $mostrar=$this->db->query(" select * from CM_Variables as CV INNER JOIN CM_CuadroMandoVariablesDetalle AS CDT ON CDT.idVariable=CV.idVariable WHERE CV.cTipo='Q' AND CV.iTipo != 0 $mes $anio $cuadro ");
      return $mostrar->getResult(); 
  }
  function get_ListadoCualitativas($anio,$cuadro,$mes){
    if($anio !=''){
      $anio=" AND YEAR(cv.dFecCre)='$anio'";
    }if($cuadro !=''){
      $cuadro=" and CDT.iCuadro='$cuadro'";
    }if($mes !=''){
      $mes=" AND CDT.iMes='$mes'";
    }
    $mostrar=$this->db->query(" select * from CM_Variables as CV INNER JOIN CM_CuadroMandoVariablesDetalle AS CDT ON CDT.idVariable=CV.idVariable WHERE CV.cTipo='C' AND CV.iTipo != 0 $mes $anio $cuadro ");
    return $mostrar->getResult(); 
}
function ActualizarCuadro($idVariable,$iMes,$nValor){
 $db=db_connect();
        $mostrar=$db->query(
        " update CM_CuadroMandoVariablesDetalle set nValor=$nValor WHERE idVariable='$idVariable' and iMes=$iMes");
        return $mostrar->getResult();

}
function ActualizarCuadroCual($idVariable,$iMes,$cValor){
  $db=db_connect();
         $mostrar=$db->query(
         " update CM_CuadroMandoVariablesDetalle set cValor='$cValor' WHERE idVariable='$idVariable' and iMes=$iMes");
         return $mostrar->getResult();
 
 }



           
}