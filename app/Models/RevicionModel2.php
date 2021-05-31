<?php namespace App\Models;

use CodeIgniter\Model;

class RevicionModel2 extends Model{ 
    protected $table      = 'GF_RevisionVehicular';
    protected $primaryKey = 'cCodConsecutivo';

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

    function insertar($cCodConsecutivo,$nConsecutivo,$cCodEmp,$cPlacaVeh,$dFecReg,$nCodTipRev,$cCodAccionM,$cTipoAccionM,$cCodJefe,$dFecVBJefe,$cCodSup,$dFecVBJSup,$cObservaciones,$iEstado,$cIdUsuCre,$dFecCre,$cIdUsuMod,$dFecMod){
        $db=db_connect();
        $mostrar=$db->query("INSERT INTO sis_mega.dbo.GF_RevisionVehicular (cCodConsecutivo,nConsecutivo
        ,cCodEmp,cPlacaVeh,dFecReg,nCodTipRev,
        cCodAccionM,cTipoAccionM,cCodJefe,
        dFecVBJefe,cCodSup,dFecVBJSup,
        cObservaciones,iEstado,
        cIdUsuCre,dFecCre,
        cIdUsuMod,dFecMod) VALUES 
        ('$cCodConsecutivo', '$nConsecutivo', '$cCodEmp', 
        '$cPlacaVeh', '$dFecReg', 
        '$nCodTipRev', '$cCodAccionM','$cTipoAccionM','$cCodJefe',
        '$dFecVBJefe', '$cCodSup','$dFecVBJSup',
        '$cObservaciones','$iEstado', 
        '$cIdUsuCre','$dFecCre',
        '$cIdUsuMod','$dFecCre')");
        return $mostrar->getResult();
    }
   
    
}