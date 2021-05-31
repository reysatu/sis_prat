  <!-- Full Width Column -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/mycss/queries.css">
  <div class="content-wrapper">
     <div class="container-fluid" >
      <section class="content">
        <div class="box box-success">
         <div class="box-header with-border">
            <div class="row">
              <form action="" id="form_RevisionVehicularEditar">
               <div class="col-lg-5 col-xs-12 ">
                  <label for="inputEmail3" class="col-lg-2 col-xs-12 control-label">Consecutivo:</label>
                  <div class="col-lg-8 col-xs-8">
                  <input type="hidden"  name="cCodConsecutivo" id="cCodConsecutivo" value="<?php echo $datos_select->Codigo?>">
                    <select class="form-control" disabled>
                      <option selected="selected" value="">Seleccione</option>
                      <?php  foreach($infconsecutivo as $linea):?>
                        <?php if(!empty($datos_select)):?>
                        <?php if($datos_select->Codigo==$linea->cCodConsecutivo): ?>
                            <option selected="selected" value="<?php echo $linea->cCodConsecutivo?>"><?php echo $linea->cDetalle?> </option>
                            <?php continue?>
                            <?php endif ?>
                        <?php endif ?>
                        <option value="<?php echo $linea->cCodConsecutivo?>"><?php echo $linea->cDetalle?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-lg-2 col-xs-4">
                    <input type="text" class="form-control" id="RV_consecutivo" name="RV_consecutivo" value="<?php echo($datos_select->Nro) ?>" placeholder="" readonly>
                  </div>
               </div>
               <div class="col-lg-2 col-xs-12 ">
                  <label for="inputEmail3" class="col-lg-3 control-label">Fecha:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control datepicker2" id="red_feReg" name="red_feReg"  placeholder="" value="<?php echo($datos_select->Fecha) ?>" >
                  </div>
               </div>
               <div class="col-lg-3 col-xs-12 ">
                  <label for="inputEmail3" class="col-lg-2 control-label">Placa:</label>
                  <div class="col-lg-10">
                  <input type="hidden" id="red_placa" name="red_placa" value="<?php echo $datos_select->Placa?>" >
                    <select class="form-control select3"  disabled>
                      <option selected="selected" value="">Seleccione </option>
                      <?php  foreach($get_placas as $linea):?>
                        <?php if(!empty($datos_select)):?>
                        <?php if($datos_select->Placa==$linea->Codigo): ?>
                            <option selected="selected" value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?>   <?php echo $linea->Color ?>  <?php echo $linea->Marca?> </option>
                            <?php continue?>
                            <?php endif ?>
                        <?php endif ?>
                        <option value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?>   <?php echo $linea->Color ?>  <?php echo $linea->Marca?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
               </div>
               <div class="col-lg-2 col-xs-12 ">
                  <label for="inputEmail3" class="col-lg-4 control-label">Estado:</label>
                  <div class="col-lg-8">
                    <input id="RV_estado" type="hidden" class="form-control"  value="<?php echo($datos_select->Estado) ?>"  placeholder="" readonly>
                    <?php if($datos_select->Estado=='1'){
                        $estadov='Abierto';}else{$estadov='Cerrado';}?>
                    <input id="RV_estadov" type="text" class="form-control"  value="<?php echo($estadov) ?>"  placeholder="" readonly>
                  </div>
               </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-5">
                <label for="inputEmail3" class="col-lg-2 control-label">Chofer:</label>
                  <div class="col-lg-10">
                    <select class="form-control select4" id="red_Chofer" name="red_Chofer"  >
                      <option selected="selected" value="" >Seleccione </option>
                      <?php  foreach($get_chofer as $linea):?>
                        <?php if(!empty($datos_select)):?>
                        <?php if($datos_select->codChofer==$linea->Codigo): ?>
                            <option  selected="selected" value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> <?php echo $linea->Descripcion?> </option>
                            <?php continue?>
                            <?php endif ?>
                        <?php endif ?>
                        <option value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> <?php echo $linea->Descripcion?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
              </div>
              <div class="col-lg-3">
              <label for="inputEmail3" class="col-lg-3 control-label">Revisión:</label>
                  <div class="col-lg-9">
                  <input type="hidden"  id="red_nRev" name="red_nRev"  value="<?php echo($datos_select->codAccion)?>">
                    <select class="form-control"disabled>
                      <option selected="selected" value="">Seleccione</option>
                        <option <?php if($datos_select->codAccion=='1RO'){echo "selected";}?> value="1RO">PRIMERO</option>
                        <option <?php if($datos_select->codAccion=='2DO'){echo "selected";}?> value="2DO">SEGUNDO</option>
                    </select>
                  </div>
              </div>
              <div class="col-lg-4">
              <label for="inputEmail3" class="col-lg-4 control-label">Tipo Revisión:</label>
                  <div class="col-lg-8">
                    <input type="hidden" class="form-control" id="red_tipoRevision" name="red_tipoRevision" value="<?php echo($datos_select->CodTipRev) ?>" >        
                    <input type="text" class="form-control" id="red_tipoRevisionE" name="red_tipoRevisionE" value="<?php echo($datos_select->TipoRevision) ?>" readonly>
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-5">
                <label for="inputEmail3" class="col-lg-2 control-label">Supervisor:</label>
                  <div class="col-lg-10">
                    <select class="form-control select4" id="red_supervisor" name="red_supervisor">
                      <option selected="selected" value="">Seleccione Supervisor</option>
                      <?php  foreach($get_supervisor as $linea):?>
                        <?php if(!empty($datos_select)):?>
                        <?php if($datos_select->CodSup==$linea->Codigo): ?>
                            <option selected value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> <?php echo $linea->Descripcion?> </option>
                            <?php continue?>
                            <?php endif ?>
                        <?php endif ?>
                        <option value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> <?php echo $linea->Descripcion?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
              </div>
              <div class="col-lg-5">
              <label for="inputEmail3" class="col-lg-4 control-label">Fecha de Rev.Sup:</label>
                  <div class="col-lg-4">
                  <input type="RV_consecutivo" class="form-control datepicker2" id="red_fechaSup" name="red_fechaSup" placeholder="" value="<?php echo($datos_select->FechaJs) ?>" >
                  </div>
              </div>
              
            </div>
            <br>
            <div class="row">
              <div class="col-lg-5">
                <label for="inputEmail3" class="col-lg-2 control-label">Jefe:</label>
                  <div class="col-lg-10">
                    <select class="form-control select5 " id="red_jefe" name="red_jefe" >
                      <option selected="selected" value="">Seleccione Jefe</option>
                      <?php  foreach($get_supervisor as $linea):?>
                        <?php if(!empty($datos_select)):?>
                        <?php if($datos_select->CodJefe==$linea->Codigo): ?>
                            <option selected value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> <?php echo $linea->Descripcion?> </option>
                            <?php continue?>
                            <?php endif ?>
                        <?php endif ?>
                        <option value='<?php echo $linea->Codigo?>'><?php echo $linea->Codigo?> <?php echo $linea->Descripcion?> </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
              </div>
              <div class="col-lg-5">
              <label for="inputEmail3" class="col-lg-4 control-label">Fecha de Rev.Jefe:</label>
                  <div class="col-lg-4">
                    <input type="RV_consecutivo" class="form-control datepicker2" id="red_fechaJef" name="red_fechaJef" placeholder=""  value="<?php echo($datos_select->FechaJs) ?>"   >
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-12">
              <label for="inputEmail3" class="col-lg-1 control-label">Observación:</label>
                  <div class="col-lg-11">
                    <textarea type="text" class="form-control " id="red_observacion" name="red_observacion" placeholder="" value="<?php echo($datos_select->observaciones) ?>"><?php echo($datos_select->observaciones) ?></textarea>
                  </div>
              </div>
            </div>
            <br>
            
            <div class="row">
              <div class="col-lg-4">
                <label for="inputEmail3" class="col-lg-7 control-label">Detalle de Revisiones a Realizar:</label>
                <div class="col-lg-3">
                <button type="button" class="btn btn-block btn-primary btn-xs " id="btn_EditarRv" <?php echo($estadoBoton)?> >Guardar </button>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="col-lg-6">    
                    <label>
                      <input type="checkbox" id="checkblanco"> En blanco = OK
                    </label>
                </div>         
                <div class="col-lg-6">    
                    <strong><p style="cursor:pointer;color:#39b2d9" data-toggle="modal" data-target="#myModal">Ver Acciones a Registrar</p></strong>
                </div> 
              </div>
              <div class="col-lg-2" style="margin-bottom:10px" >
                <div class="col-lg-12">
                <button type="button" class="btn btn-block btn-primary btn-xs" id="guardar_Revd" <?php echo($estadoBoton)?>  >Guardar Modificaciones</button>
                </div>
              </div>
            
              <div class="col-lg-2 col-xs-12"  >
                <div class="col-lg-6 col-xs-6">
                  <button type="button" onclick="reportExcel()" class="btn btn-block btn-success btn-xs" id="export_Revd" ><i class="fa fa-file-excel-o"></i></button>
                </div>
                 <div class="col-lg-6 col-xs-6">
                  <button type="button" onclick="printPDF()" class="btn bg-navy btn-block  btn-xs" id="export_Revd" ><i class="fa  fa-print"></i></button>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-12">
              <div class="box-body" >
              
            <table id="table_default" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                  <th>Grupo</th>
                  <th>Revision</th>
                  <th>Accion</th>
                  <th>AccionCorrectiva</th>
                  <th>Orden</th>
                  <th>NroOrden</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach($get_datosselectDetalle as $linea):?>
                    <tr>
                        <td class="col-sm-2" ><input  type='hidden' value="<?php echo($linea->nCodRev)?>"><?php echo($linea->cGrupo)?></td>
                        <td class="col-sm-2" ><input name='nCodRev[]' type='hidden' value="<?php echo($linea->nCodRev)?>"><input name='nCodGrupoRev[]' type='hidden' value="<?php echo($linea->nCodGrupoRev)?>"><?php echo($linea->cRevision)?></td>
                        <td class='accion_revision' onclick='accion1(<?php echo($linea->nCodRev)?>)' style='cursor:pointer'>
                            <input type='hidden' value="<?php echo($linea->nCodRev)?>"><input class='accion_guardar' name='cCodAccionR[]' type='hidden' value='<?php echo($linea->cCodAccionR)?>'><p><?php echo($linea->cCodAccionR)?></p>
                        </td>
                        <td style='cursor:pointer' class='input_correctivo' onclick='accion2(this)' data-valo='A'>
                          <?php if($linea->cAccionCorr!=null): ?>
                            <input type='text' name='cAccionCorr[]' id='accionCorrectivo_agregar' value='<?php echo($linea->cAccionCorr)?>' />
                          <?php else: ?>
                            <input name='ejemp' type='hidden' value='A'/>
                          <?php endif?>
                        
                        </td>
                        <td><input name='cCodConsecutivoOS[]' class='Orden_guardar' type='hidden' value='<?php echo($linea->cCodConsecutivoOS)?>'><?php echo($linea->cCodConsecutivoOS)?> <p></p> </td>
                        <td class='nro_orden' style='cursor:pointer' onclick='accion3(<?php echo($linea->nCodRev)?>)'><input type='hidden' value="<?php echo($linea->nCodRev)?>"><input name='nConsecutivoOS[]' class='NroOrden_guardar' type='hidden' value='<?php echo($linea->nConsecutivoOS)?>'><p><?php echo($linea->nConsecutivoOS)?></p></td>
                    </tr>
                 <?php endforeach; ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
            </form>
          </div>
              </div>
            </div>
         </div>
        </div>
      </section>
     </div>
  </div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Descripcion</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($acciones_revision as $linea):?>
                <tr>
                    <td><?php echo($linea->Codigo)?></td>
                    <td><?php echo($linea->Descripcion)?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
        
      </div>
    </div>
  </div>
  <div class="modal fade" id="accion_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
        <input type="hidden" id="indent">
        <table class="table table-bordered" id="tableaccion"> 
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Descripcion</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($acciones_revision as $linea):?>
                <tr>
                    <td class="codAccionModal" style="cursor:pointer;height:50px !important"><input type="hidden" value="<?php echo($linea->Codigo)?>"><?php echo($linea->Codigo)?></td>
                    <td class="desAccionModal" style="cursor:pointer" ><input type="hidden" value="<?php echo($linea->Codigo)?>"><?php echo($linea->Descripcion)?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
        
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_orden" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-body"  >
        <div class="card">
          <div id="table" class="table-editable">  
          <input type="hidden" id="indent_orden"> 
        <table class="table table-bordered "  id="tableOrden" >
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Placa</th>
            </tr>
          </thead>
          <tbody>
            <?php  foreach($get_ordenes as $row):?>
              <tr>
                <td class='desOrdenModal' onclick=accion4(<?php echo("'$row->Codigo,$row->Descripcion'")?>) style='cursor:pointer;height:50px !important'><input type='hidden' value="<?php echo("$row->Codigo,$row->Descripcion")?>"><?php echo($row->Codigo)?></td>
                <td class='desOrdenModal' onclick=accion4(<?php echo("'$row->Codigo,$row->Descripcion'")?>) style='cursor:pointer' ><input type='hidden' value="<?php echo("$row->Codigo,$row->Descripcion")?>"><?php echo($row->Descripcion)?></td>
                <td class='desOrdenModal' onclick=accion4(<?php echo("'$row->Codigo,$row->Descripcion'")?>) style='cursor:pointer' ><input type='hidden' value="<?php echo("$row->Codigo,$row->Descripcion")?>"><?php echo($row->Placa)?></td> 
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
      </div>
        </div>
      </div>
      
    </div>
  </div>  