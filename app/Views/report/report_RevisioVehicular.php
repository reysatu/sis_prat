<?php  $numR = array("I","II","III","IV","V","VI","VII","VIII","IX","X"); $a1=0; $num=5;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url();?>/public/mycss/queries.css">
    <title>Document</title>
</head>
<body>
<table class="tabla_export">
<tr align="center"  >
        <th width="160" ></th>
        <th width="80"></th>
        <th width="80"></th>
        <th width="80"></th>
        <th width="80"></th>
        <th width="80" ></th>
        <th width="120"></td>
    </tr>
    <tr align="center"  >
        <td rowspan="3" ><img width="50" src="<?php echo base_url();?>/logo_empresa.png" alt=""></td>
        <td  class="fondoexport" colspan="4" height ="40" style="font-size:10px;" ><?php echo $getEmpresa->TipoDoc ?></td>
        <td style="font-size:10px;">Código</td>
        <td style="font-size:10px;"  ><?php echo $getEmpresa->CodDocumento ?></td>
    </tr>
     <tr align="center">
        <td class="fondoexport" rowspan="2"  colspan="4"   style="font-size:10px;"><?php echo $getEmpresa->Documento ?></td>
        <td style="font-size:10px;">VERSIÓN</td>
        <td style="font-size:10px;"><?php echo $getEmpresa->Version ?></td>
    </tr>
    <tr align="center">
        <td style="font-size:10px;">FECHA</td>
        <td style="font-size:10px;"><?php echo $getEmpresa->FechaVersion ?></td>
    </tr>
       <tr height="3"></tr>
    <tr >
        <td class="fondoexport" style="font-size:10px;"><div class="expor_left">RAZON SOCIAL:</div></td>
        <td align="center"  colspan="4" style="font-size:12px;"><?php echo $getEmpresa->RazonSocial ?> </td>
        <td class="fondoexport"  align="center" style="font-size:10px;">RUC</td>
        <td align="center" style="font-size:12px;"><?php echo $getEmpresa->RUC ?></td>
    </tr>
    
    <tr >
        <td class="fondoexport"   style="font-size:10px;"><div align="left" class="expor_left">TIPO DE ACTIVIDAD ECONÓMICA:</div></td>
        <td align="center"  colspan="4" style="font-size:12px;"><?php echo $getEmpresa->Actividad ?></td>
        <td class="fondoexport"  rowspan="2"  align="center" style="font-size:10px;">N° DE TRABAJADORES</td>
        <td rowspan="2" align="center" style="font-size:12px;"><?php echo $getEmpresa->Trabajadores?></td>
    </tr>
    
    <tr >
        <td class="fondoexport"   style="font-size:10px;">DIRECCIÓN:</td>
        <td align="center"  colspan="4" style="font-size:10px;"><?php echo $getEmpresa->Direccion?></td>
    </tr>
    <th colspan="7" height="20" style="font-size:11px;" >FECHA: <?php echo $datosrv->Fecha ?>   REVISIÓN: <?php echo $datosrv->codAccion ?>   </th>
    <tr align="">
        <td   class="fondoexport" style="font-size:10px;">I. PLACA DEL VEHÍCULO</td>
        <td  align="center" colspan="2" style="font-size:10px;"> <b><?php echo $datosrv->Placa ?></b> </td>
        <td class="fondoexport" colspan="2" style="font-size:10px;">III. MES</td>
        <td align="center" colspan="2" style="font-size:10px;"> <b><?php echo  $mes ?></b> </td>
    </tr>
    <tr align="">
        <td class="fondoexport"  style="font-size:10px;">II.TIPO DE UNIDAD</td>
        <td align="center" colspan="2" style="font-size:10px;"> <b><?php echo $datosrv->Unidad_veh ?></b></td>
        <td class="fondoexport" colspan="2" style="font-size:10px;">IV.TRANSPORTISTA</td>
        <td align="center" colspan="2" style="font-size:10px;"><b><?php echo $datosrv->Chofer ?></b></td>
    </tr>
    <tr height="5"></tr>
    <?php foreach($datosDet as $row):?>
    <?php  $grupo=$row->cGrupo; ?>
    <?php if($a1==0): ?>
    <?php  $valorgrup=$grupo;$numi= $numR[$num-1]; ?>
    <tr align="">
        <td class="fondoexport" colspan="3"  style="font-size:10px;"><?php echo($numi .". ". $row->cGrupo) ?></td>
        <td class="fondoexport"  align="center"   style="font-size:12px;">Acción</td>
        <td align="center" class="fondoexport" colspan="3" style="font-size:13px;">Acción Correctiva</td>
    </tr>
    <tr align="">
        <td colspan="3"  style="font-size:10px;"><?php echo $row->cRevision ?></td>
        <td align="center"   style="font-size:10px;"><?php echo $row->cCodAccionR ?></td>
        <td colspan="3" style="font-size:10px;">
        <div style="width: 100%;text-align: justify;">
            <?php echo $row->cAccionCorr ?>
        </div>
        </td>
    </tr>
    <?php  $a1=$a1+1;$num=$num+1;?>
    <?php else:?>
        <?php if($valorgrup!=$grupo):?>
            <?php  $valorgrup=$grupo;$numi= $numR[$num-1]; ?>
            <tr align="">
        <td class="fondoexport" colspan="3"  style="font-size:10px;"><?php echo($numi .". ". $row->cGrupo) ?></td>
        <td class="fondoexport"  align="center"   style="font-size:12px;">Acción</td>
        <td align="center" class="fondoexport" colspan="3" style="font-size:13px;">Acción Correctiva</td>
    </tr>
    <tr align="">
        <td colspan="3"  style="font-size:10px;"><?php echo $row->cRevision ?></td>
        <td align="center"   style="font-size:10px;"><?php echo $row->cCodAccionR ?></td>
        <td colspan="3" style="font-size:10px;">
        <div style="width: 100%;text-align: justify;">
            <?php echo $row->cAccionCorr ?>
        </div>
        </td>
    </tr>
    <?php  $a1=$a1+1;$num=$num+1;?>
        <?php else:?>
            <tr align="">
                <td colspan="3"  style="font-size:10px;"><?php echo $row->cRevision ?></td>
                <td align="center"   style="font-size:10px;"><?php echo $row->cCodAccionR ?></td>
                <td colspan="3" style="font-size:10px;">
                <div style="width: 100%;text-align: justify;">
                    <?php echo $row->cAccionCorr ?>
                </div>
                </td>
            </tr>
            <?php  $a1=$a1+1;?>
    <?php endif ?>
    <?php endif ?>
    <?php endforeach ?>
    <tr height="10"></tr>
     <tr> <th colspan="7"  style="font-size:9px;">Leyenda : OK : Cumple  -  NO : No Cumple  -  F : Presencia de una falla - R : Reparado o Repuesto el accesorio</td></th>
   
</table>
<p  style="font-size:9px;"> (*) El llenado de este formato es obligación de cada usuario antes del inicio de sus actividades																</p>
<p  style="font-size:9px;">(*) Las observaciones  en la verificación del vehículo y al estar en ruta serán llenados en el reverso de éste registro</p>
<div class="saltoDePagina"></div>
<table class="tabla_export">
    <tr align="center"  >
            <th width="160" ></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80" ></th>
            <th width="120"></th>
    </tr>
    <tr align="center"  >
            <td colspan="3" class="fondoexport"  style="font-size:10px;"  >Revisión</td>
            <td colspan="4" class="fondoexport"  width="80"></td>
    </tr>
    <tr align="center"  >
            <td colspan="3"   style="font-size:14px;" >Firma del Chofer de la unidad de transporte</td>
            <td colspan="4" height ="50"></td>
    </tr>
    <tr align="center"  >
            <td colspan="3" style="font-size:14px;" >V°B Jefe Inmediato</td>
            <td colspan="4" height ="50"></td>
    </tr>
    <tr align="center"  >
            <td colspan="3"  style="font-size:14px;" >V°B Sup. SST</td>
            <td colspan="4" height ="50"></td>
    </tr>
</table>
<p style="font-size:13px;" ><b>REGISTRO DE OBSERVACIONES POR PARTE DEL CHOFER DE TRANSPORTE EN LA FECHA: <?php echo $datosrv->Fecha ?></b></p>
<p style="font-size:13px;" ><b>Observaciones Adicionales:</b></p>

<table class="tabla_export">
    <tr align="center"  >
            <th width="160" ></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80" ></th>
            <th width="120"></th>
    </tr>
    <tr align=""  >
            <td colspan="7"  height ="20"  style="font-size:14px;"  ><?php echo $datosrv->observaciones?></td>
          
    </tr>
    <tr align="center"  >
            <td colspan="7"  height ="20" style="font-size:14px;" ></td>
          
    </tr>
    <tr align="center"  >
            <td colspan="7" height ="20" style="font-size:14px;" ></td>
           
    </tr>
    <tr align="center"  >
            <td colspan="7" height ="20"  style="font-size:14px;" ></td>
         
    </tr>
    <tr align="center"  >
            <td colspan="7" height ="20" style="font-size:14px;" ></td>
         
    </tr>
    <tr align="center"  >
            <td colspan="7" height ="20"  style="font-size:14px;" ></td>
         
    </tr>
</table>
<br>
<table class="tabla_export">
<tr align="left"  >
            <th height ="200" width="160" ></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80"></th>
            <th width="80" ></th>
            <th width="120"></th>
    </tr>
    <tr align="left">
            <th colspan="7"   style="font-size:14px;"  >___________________</th>
            
    </tr> 
    <tr align="left">
            <th colspan="7"   style="font-size:14px;"  > Supervisor de la Flota	</th>
            
    </tr> 
</table>
</body>
</html>
<script>
window.print();
</script>










