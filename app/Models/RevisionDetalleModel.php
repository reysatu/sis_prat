<?php namespace App\Models;

use CodeIgniter\Model;

class RevisionDetalleModel extends Model{ 
    protected $table      = 'GF_RevisionVehicularDet';
    protected $primaryKey = 'cCodConsecutivo';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ["cCodConsecutivo","nConsecutivo","nCodTipRev","nCodRev","dFecReg","nCodTipRev","nCodGrupoRev","cCodAccionR","cTipoAccionR","bLevantada","cCodConsecutivoOS","nConsecutivoOS","cIdUsuCre","cIdUsuMod"];

    protected $useTimestamps = false;
    protected $createdField  = 'dFecCre';
    protected $updatedField  = 'dFecMod';
    

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    function insertar_db($cCodConsecutivo,$nConsecutivo,$nCodTipRev,$nCodRev,
    $nCodGrupoRev,$cCodAccionR,$cTipoAccionR,$cAccionCorr,$bLevantada,
    $cCodConsecutivoOS,$nConsecutivoOS,$cIdUsuCre,$cIdUsuMod,$dFecMod,$dFecCre){
        
        $db=db_connect();
        $mostrar=$db->query("INSERT INTO sis_mega.dbo.GF_RevisionVehicularDet(cCodConsecutivo,nConsecutivo,nCodTipRev,nCodRev,
        nCodGrupoRev,cCodAccionR,cTipoAccionR,cAccionCorr,bLevantada,cCodConsecutivoOS,nConsecutivoOS,cIdUsuCre,cIdUsuMod,dFecMod,dFecCre) VALUES 
        ('$cCodConsecutivo','$nConsecutivo','$nCodTipRev','$nCodRev','$nCodGrupoRev',NULLIF ( '$cCodAccionR' , '' ),NULLIF ( '$cTipoAccionR' , '' ),NULLIF ( '$cAccionCorr' , '' )  ,NULLIF ( '$bLevantada' , '' ),NULLIF ( '$cCodConsecutivoOS' , '' ),'$nConsecutivoOS','$cIdUsuCre','$cIdUsuMod','$dFecMod','$dFecCre')");
        
        //('$cCodConsecutivo','$nConsecutivo','$nCodTipRev','$nCodRev','$nCodGrupoRev','$cCodAccionR','$cTipoAccionR',NULLIF ( '$cAccionCorr' , '' ),'$bLevantada','$cCodConsecutivoOS',NULLIF ( '$nConsecutivoOS' , 0 ),'$cIdUsuCre','$cIdUsuMod','$dFecMod','$dFecCre')
        return $mostrar->getResult();
    }
    function eliminar_dt($id){
        $db=db_connect();
        $mostrar=$db->query("delete from GF_RevisionVehicularDet where nConsecutivo='$id'");
        
        //('$cCodConsecutivo','$nConsecutivo','$nCodTipRev','$nCodRev','$nCodGrupoRev','$cCodAccionR','$cTipoAccionR',NULLIF ( '$cAccionCorr' , '' ),'$bLevantada','$cCodConsecutivoOS',NULLIF ( '$nConsecutivoOS' , 0 ),'$cIdUsuCre','$cIdUsuMod','$dFecMod','$dFecCre')
        return $mostrar->getResult();  
    }

    
    // INSERT INTO sis_mega.dbo.GF_RevisionVehicularDet (cCodConsecutivo,nConsecutivo,nCodTipRev,nCodRev,
    // nCodGrupoRev,cCodAccionR,cTipoAccionR,cAccionCorr,bLevantada,
    // cCodConsecutivoOS,nConsecutivoOS,cIdUsuCre,cIdUsuMod,dFecMod,dFecCre) VALUES 
    // ('$cCodConsecutivo','$nConsecutivo','$nCodTipRev','$nCodRev',
    //     '$nCodGrupoRev','$cCodAccionR','$cTipoAccionR','$cAccionCorr','$bLevantada',
    //     '$cCodConsecutivoOS','$nConsecutivoOS','$cIdUsuCre','$cIdUsuMod','$dFecMod','$dFecCre')
}