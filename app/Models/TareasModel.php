<?php namespace App\Models;
use CodeIgniter\Model;
class TareasModel extends Model{ 

    function get_tareasFiltros($fechaI,$fechaF,$textbus,$tipoTarea,$estado,$prioridad,$validada){
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
      $db=db_connect();
      $mostrar=$db->query("select *,Convert(DATE, dFecIni) as dFecIni,Convert(DATE, dFecFin) as dFecFin from  GT_Tareas AS TA INNER JOIN VW_GRAREAS AS AR ON TA.nCodArea=AR.Codigo INNER JOIN GT_Proyecto AS PR ON TA.nCodProy=PR.nCodProy inner JOIN GT_Empleado AS EM ON TA.cCodEmpResp=EM.cCodEmp INNER JOIN GT_Prioridad AS PRI ON TA.nCodPri=PRI.nCodPri INNER JOIN GT_Estado AS ES ON TA.nCodEst=ES.nCodEst where 1=1  $textbus $fechaI $fechaF $tipoTarea $estado $prioridad $validada");
      return $mostrar->getResult();
      }
    function get_tareas(){
        $db=db_connect();
        $mostrar=$db->query("select *,Convert(DATE, dFecIni) as dFecIni,Convert(DATE, dFecFin) as dFecFin from  GT_Tareas AS TA INNER JOIN VW_GRAREAS AS AR ON TA.nCodArea=AR.Codigo INNER JOIN GT_Proyecto AS PR ON TA.nCodProy=PR.nCodProy inner JOIN GT_Empleado AS EM ON TA.cCodEmpResp=EM.cCodEmp INNER JOIN GT_Prioridad AS PRI ON TA.nCodPri=PRI.nCodPri INNER JOIN GT_Estado AS ES ON TA.nCodEst=ES.nCodEst ");
        return $mostrar->getResult();
        }
    function get_tipoTarea(){
          $db=db_connect();
          $mostrar=$db->query("select nCodProy, cProyecto from GT_Proyecto WHERE bEstado='1' ");
          return $mostrar->getResult();
          }
    function get_estadoTarea(){
      $db=db_connect();
          $mostrar=$db->query("select nCodEst,cEstado from GT_Estado WHERE bEstado='1'");
          return $mostrar->getResult(); 
    }
    function get_prioridadTarea(){
      $db=db_connect();
          $mostrar=$db->query("select nCodPri,cPrioridad from GT_Prioridad WHERE bEstado='1'");
          return $mostrar->getResult(); 
    }           
}