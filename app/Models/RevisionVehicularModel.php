<?php namespace App\Models;

use CodeIgniter\Model;

class RevisionVehicularModel extends Model{ 
    protected $table      = 'GF_RevisionVehicular';
    protected $primaryKey = 'nConsecutivo';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ["cCodConsecutivo","nConsecutivo","cCodEmp","cPlacaVeh","dFecReg","nCodTipRev","cCodAccionM","cTipoAccionM","cCodJefe","dFecVBJefe","cCodSup","dFecVBJSup","cObservaciones","iEstado","cIdUsuCre","dFecCre","cIdUsuMod","dFecMod"];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false; 
    function get_datosselect($id){
        $db=db_connect();
        $mostrar=$db->query("select Convert(DATE, dFecReg) as Fecha,Convert(DATE, dFecVBJefe) as FechaJs,rv.cObservaciones as observaciones, rv.iEstado as Estado, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,rv.cCodEmp as codChofer,am.cCodAccion as codAccion,tr.nCodTipRev as CodTipRev,rv.cCodJefe as CodJefe,rv.cCodSup as CodSup,
        rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,
        am.cAccion as Revision,ch.Descripcion as Chofer, 
        cs.Descripcion as Supervisor, 
        cj.Descripcion as Jefe, TU.cTipoUnidad as Unidad_veh  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am
        on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo inner join GF_TipoUnidad as TU on TU.nCodTipUni=tr.nCodTipUni where rv.nConsecutivo='$id'");
        return $mostrar->getRow();
    }
    function get_empresa(){
        $db=db_connect();
        $mostrar=$db->query("SELECT C.RUC,C.RazonSocial,C.Direccion,C.Actividad, C.Trabajadores,
        D.cCodDocReg CodDocumento, D.cNombre Documento, TD.cTipoDocReg TipoDoc, 
        D.cVersion Version, convert(date,D.dFecVer) [FechaVersion]
        from GF_DocReg D  
        INNER JOIN GF_TipoDocReg TD ON TD.cCodTipoDocReg = D.cCodTipoDocReg
        CROSS JOIN VWGFCompanias C
        where D.cCodDocReg = 'DSM-PO-DIT-FO-14' AND D.bEstado = 1");
        return $mostrar->getRow(); 
    }
    function update_rv($cCodEmp,$cCodSup,$cCodJefe,$dFecVBJSup,$dFecVBJefe,$cObservaciones,$dFecReg,$RV_consecutivo){
        $db=db_connect();
        $mostrar=$db->query(
        "update GF_RevisionVehicular set cCodEmp='$cCodEmp',
        cCodSup='$cCodSup',cCodJefe='$cCodJefe',dFecVBJSup='$dFecVBJSup',cObservaciones= NULLIF ( '$cObservaciones' , '' ),dFecReg='$dFecReg' where nConsecutivo='$RV_consecutivo';
      ");
        return $mostrar->getResult();
    }
    function get_datosselectDetalle($id){
        $db=db_connect();
        $mostrar=$db->query("select * from GF_RevisionVehicularDet as  rvd inner join GF_TipoRevision as TipRev on rvd.nCodTipRev=TipRev.nCodTipRev INNER JOIN GF_Revision as rev on rev.nCodRev=rvd.nCodRev inner join GF_GrupoRevision as GrRE on rvd.nCodGrupoRev=GrRE.nCodGrupoRev where rvd.nConsecutivo='$id'");
        return $mostrar->getResult();
       
    }
    function cambiar_estado($nConsecutivo){
        $db=db_connect();
        $mostrar=$db->query("update GF_RevisionVehicular set iEstado='0' where nConsecutivo='$nConsecutivo'");
        return $mostrar->getResult();
    }
    function actualizar_consecutivo($nConsecutivo){
        $db=db_connect();
        $mostrar=$db->query("update GF_Consecutivos set nConsecutivo='$nConsecutivo' where nCodSede='1' and cCodConsecutivo='RVHT'");
        return $mostrar->getResult();
    }
    function mostrar3($Fecha_Inicio,$Fecha_Fin,$placa){
        $db=db_connect();
        $mostrar=$db->query("select Convert(DATE, dFecReg) as Fecha, rv.iEstado as Estado, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,
        rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,
        am.cAccion as Revision,ch.Descripcion as Chofer, 
        cs.Descripcion as Supervisor, 
        cj.Descripcion as Jefe  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am
        on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo WHERE Convert(DATE, dFecReg) between ' $Fecha_Inicio ' and ' $Fecha_Fin ' AND  rv.cPlacaVeh='$placa'");
        return $mostrar->getResult();
        }
        function mostrar2($Fecha_Inicio,$Fecha_Fin){
            $db=db_connect();
            $mostrar=$db->query("select Convert(DATE, dFecReg) as Fecha, rv.iEstado as Estado, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,
            rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,
            am.cAccion as Revision,ch.Descripcion as Chofer, 
            cs.Descripcion as Supervisor, 
            cj.Descripcion as Jefe  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am
            on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo WHERE Convert(DATE, dFecReg) between ' $Fecha_Inicio ' and ' $Fecha_Fin '");
            return $mostrar->getResult();
            }
    function mostrar($Fecha_Inicio,$Fecha_Fin){
        $db=db_connect();
        $mostrar=$db->query("select Convert(DATE, dFecReg) as Fecha, rv.iEstado as Estado, rv.cPlacaVeh as Placa ,rv.cCodConsecutivo as Codigo,
        rv.nConsecutivo as Nro,tr.cTipoRevision as TipoRevision,
        am.cAccion as Revision,ch.Descripcion as Chofer, 
        cs.Descripcion as Supervisor, 
        cj.Descripcion as Jefe  from GF_RevisionVehicular as rv inner join GF_TipoRevision as tr on rv.nCodTipRev=tr.nCodTipRev inner join GF_AccionMantenimiento as am
        on rv.cCodAccionM=am.cCodAccion inner join  VW_GFChoferesBuscar as ch on rv.cCodEmp=ch.Codigo inner join VW_GFEMPLEADOS as cj on rv.cCodJefe=cj.Codigo inner join VW_GFEMPLEADOS as cs on rv.cCodSup=cs.Codigo WHERE Convert(DATE, dFecReg) between ' $Fecha_Inicio ' and ' $Fecha_Fin '");
        return $mostrar->getResult();
        }
    function get_placas(){
        $db=db_connect();
        $mostrar=$db->query("select * from  VW_GFVehiculosBuscar WHERE Sede='1'");
        return $mostrar->getResult();
    } 
    function get_infconsecutivo(){
        $mostrar=$this->db->query("SELECT * FROM GF_Consecutivos WHERE nCodSede='1' And cCodConsecutivo='RVHT'");
        return $mostrar->getResult(); 
    }  
    function get_chofer(){
        $mostrar=$this->db->query("select * from VW_GFChoferesBuscar where nCodSede='1'");
        return $mostrar->getResult(); 
    }
    function get_supervisor(){
        $mostrar=$this->db->query("select * from VW_GFEMPLEADOS");
        return $mostrar->getResult(); 
    }  
    function get_tipoRevision(){
        $mostrar=$this->db->query("select * from GF_TipoRevision");
        return $mostrar->getResult(); 
    }
    function validar_placa($placa,$fecha){
        $mostrar=$this->db->query("select * from [dbo].[GF_Chofer_Vehiculo] as chv inner join VW_GFChoferesBuscar as ch on ch.Codigo=chv.cCodEmp
        where cPlacaVeh='$placa' AND '$fecha'>=CONVERT(DATE,dFecIni) AND '$fecha' <=CONVERT(DATE,dFecTer)");
        return $mostrar->getResult();
    }
    function get_Tipo_Revision($placa){
        $mostrar=$this->db->query("select nCodTipRev,cTipoRevision from GF_Vehiculo as vh INNER JOIN GF_TipoRevision as tr on vh. nCodTipUni=tr.nCodTipUni where cPlacaVeh='$placa'");
        return $mostrar->getResult();
    }
    function get_GroupRevision(){
        $mostrar=$this->db->query("select * from GF_Revision where nCodGrupoRev='1'");
        return $mostrar->getResult();
    }
    function get_GroupRevision2($tipoRevision){
        $mostrar=$this->db->query("select RD.nCodRev AS nCodRev,GR.cGrupo AS cGrupo,RVT.cRevision AS cRevision,RD.nCodGrupoRev AS nCodGrupoRev  from GF_TipoRevisionDet as RD inner join GF_Revision as RVT on RD.nCodRev=RVT.nCodRev INNER JOIN GF_GrupoRevision AS GR ON GR.nCodGrupoRev=RD.nCodGrupoRev WHERE RD.nCodTipRev='$tipoRevision'");
        return $mostrar->getResult();
    }
    function get_accionesRevision(){
        $mostrar=$this->db->query("select * from VW_GFACCIONES_REVISION");
        return $mostrar->getResult();
    }
    function get_orden_servicio($placa){
        $mostrar=$this->db->query("select * from VW_GFORDEN_SERVICIO where Placa='$placa'");
        return $mostrar->getResult();
    }
    function get_nconsecutivo(){
        $mostrar=$this->db->query("select nConsecutivo from GF_Consecutivos where nCodSede='1' and cCodConsecutivo='RVHT'");
        return $mostrar->getrow();
    } 
    function validaNum($cPlacaVeh,$cCodAccionM,$dFecReg){
        $mostrar=$this->db->query("select * from GF_RevisionVehicular where cPlacaVeh='$cPlacaVeh' and cCodAccionM='$cCodAccionM' and Convert(DATE, dFecReg)='$dFecReg'");
        $row = $mostrar->getRow();
        if (isset($row)){ return $row;}
        else{ return false;}
    }
    function eliminar_rv($id){
        $mostrar=$this->db->query("delete from GF_RevisionVehicular where nConsecutivo='$id'");
        return $mostrar->getResult();
    }
    function eliminar_rvDet($id){
        $mostrar=$this->db->query("delete from GF_RevisionVehicularDet where nConsecutivo='$id'");
        return $mostrar->getResult();
    }
    
    
}