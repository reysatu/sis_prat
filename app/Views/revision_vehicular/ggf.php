  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container-fluid" >
      <!-- Content Header (Page header) -->
      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <div class="col-md-2">
              <div class="form-group">
                 <a  href="<?php echo base_url()?>/Nuevo/RevisionVehicular"  title="Nuevo" class="btn btn-primary btn-icon rounded-circle mg-r-5 mg-b-10 cursor">
                  <div><span class="fa  fa-plus" data-icon="ion-add-circle" data-inline="false"></span></div>
                </a>
                 <a  title="Editar" onclick="editar_rv()" class="btn btn-success btn-icon rounded-circle mg-r-5 mg-b-10 cursor">
                  <div><span class="fa  fa-pencil" data-icon="ion-add-circle" data-inline="false"></span></div>
                </a>
                  <a  title="Eliminar" onclick="eliminar_rv()" class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10 cursor">
                  <div><span class="fa  fa-trash" data-icon="ion-add-circle" data-inline="false"></span></div>
                </a>
                <a  title="Cerrar" data-toggle="modal" data-target="#myModalCerrado" class="btn btn-default btn-icon rounded-circle mg-r-5 mg-b-10 cursor">
                  <div><span class="fa  fa-expeditedssl" data-icon="ion-add-circle" data-inline="false"></span></div>
                </a>
              </div>  
            </div>
            <form action="<?php echo current_url();?>" method="POST" >
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker1" id="datepicker1" name="FechaInicio" placeholder="Fecha inicio" value="<?php echo !empty($fechaI) ? $fechaI:'';?>">
                </div>
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker2" id="datepicker2" name="FechaFin" placeholder="Fecha fin" value="<?php echo !empty($fechaF) ? $fechaF:'';?>" required>
                </div>
              </div>  
            </div>
              <div class="col-md-4 ">
                <div class="form-group">
                  <select class="form-control select2" id="re_placa" name="re_placa">
                    <option selected="selected" value="">Seleccione Placa</option>
                    <?php  foreach($get_placas as $linea):?>
                      <?php if(!empty($placa)):?>
                       <?php if($placa==$linea->Codigo): ?>
                        <option selected="selected" value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> | <?php echo $linea->Color?> | <?php echo $linea->Marca?> </option>
                        <?php continue?>
                        <?php endif ?>
                      <?php endif ?>
                      <option value="<?php echo $linea->Codigo?>"><?php echo $linea->Codigo?> | <?php echo $linea->Color?> | <?php echo $linea->Marca?> </option>  
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
             
              <div class="col-md-2 col-xs-12">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i> 
                </button>
                <a href="<?php echo base_url(); ?>/RevisionVController" title="Limpiar" class="btn btn-warning btn-icon rounded-circle mg-r-10 mg-b-10 cursor" onclick="limpiar_table()";>
                  <div><span class="fa fa-eraser" data-icon="ion-add-circle" data-inline="false"></span></div>
                </a>
                </div> 
                <input type="hidden" name="buscar" value="Buscar" class="btn btn-primary">
              </div>
              </form>   
          </div>
          <div class="box-body" >
            <table id="example2" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Placa</th>
                  <th>Codigo</th>
                  <th>Nro</th>
                  <th>TipoRevision</th>
                  <th>Revision</th>
                  <th>Chofer</th>
                  <th>Supervisor</th>
                  <th>Jefe</th>
                  <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php  if (!empty($RevisionVehicularArray)):?>
                                        <?php  foreach($RevisionVehicularArray as $linea):?>
                                                <tr>

                                                <td class=""><input class="checkbok2" type="checkbox"  name="check" value="<?php echo $linea->Nro; ?>" id="delcheck_<?php echo $linea->Nro; ?>"  ></td>
                                                <td ><?php echo $linea->Fecha; ?></td>
                                                <td ><?php echo $linea->Placa; ?></td>
                                                
                                                <td   ><?php echo $linea->Codigo; ?></td>
                                                <td  class="" ><?php echo $linea->Nro; ?></td>
                                                <td class="" ><?php echo $linea->TipoRevision; ?></td>
                                                <td  ><?php echo $linea->Revision; ?></td>
                                                <td   ><?php echo $linea->Chofer; ?></td>
                                                <td   ><?php echo $linea->Supervisor; ?></td>
                                                <td   ><?php echo $linea->Jefe; ?></td>
                                                <?php if($linea->Estado=='1'):?>
                                                  <td   >Abierto</td>
                                                 <?php else: ?>
                                                  <td   >Cerrado</td>
                                                 <?php endif?> 
                                                </tr>
                                            <?php endforeach; ?>
                                    <?php endif; ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <div class="modal fade" id="myModalCerrado" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cierre de Transacciones de Revisiones</h4>
        </div>
        <div class="modal-body">
         <div class="row">
         <div class="col-12">
              <div class="col-md-6 col-sm-6"><input type="text" class="form-control pull-right datepicker2" id="FechaInicioCie" name="FechaInicioCie" placeholder="Fecha Inicio" ></div>
              <div class="col-md-6 col-sm-6"><input type="text" class="form-control pull-right datepicker2" id="FechaFinCie" name="FechaFinCie" placeholder="Fecha Fin" ></div>
         </div>
         </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="cerrarRevesiones()" >Guardar </button>
        </div>
      </div>
    </div>
  </div>




    <!-- Full Width Column -->
 
    <div class="content-wrapper">
    <div class="container-fluid" >
      <!-- Content Header (Page header) -->
      <section class="content">
        <div class="box">
          <div class="box-header with-border">
          <div class="row">
          <form action="<?php echo current_url();?>" method="POST" >
          <div class="col-md-1 col-xs-6">
              <div class="form-group">
              <label for="">&nbsp</label>
                  <input type="text" class="form-control input-sm pull-right "  placeholder="Tareas" Readonly value="Tareas">
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
                    <label for="">&nbsp</label>
                  <input type="text" class="form-control input-sm"  name="textbus" placeholder="Buscar" value="<?php echo !empty($textbus) ? $textbus:'';?>"  >
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <label for="">Fecha:</label>
              <div class="form-group">
                  
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control input-sm  datepicker1" id="datepicker1" name="FechaInicio" placeholder="Fecha inicio" value="<?php echo !empty($fechaI) ? $fechaI:'';?>">
                </div>
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
            <label for="exampleInputEmail1">&nbsp</label>
              <div class="form-group">
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control input-sm  datepicker2" id="datepicker2" name="FechaFin" placeholder="Fecha fin" value="<?php echo !empty($fechaF) ? $fechaF:'';?>" >
                </div>
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
              <label for="">Tipo Tarea:</label>
              <select class="form-control input-sm" name="tipoTarea"> 
                    <option value=''>TODOS</option>
                    <?php  foreach($get_tipoTarea as $linea):?>
                      <?php if(!empty($tipoTarea)):?>
                        <?php if($linea->nCodProy==$tipoTarea): ?>
                      <option selected="selected" value="<?php echo $linea->nCodProy; ?>"><?php echo $linea->cProyecto; ?></option>
                      <?php continue?>
                      <?php endif ?>
                      <?php endif ?>
                      <option value="<?php echo $linea->nCodProy; ?>"><?php echo $linea->cProyecto; ?></option>    
                    <?php endforeach?>
            </select>
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <label for="">Estado:</label>
                <select class="form-control input-sm" name="estado">
                    <option value=''>TODOS</option>
                    <?php  foreach($get_estadoTarea as $linea):?>
                      <?php if(!empty($estado)):?>
                        <?php if($linea->nCodEst==$estado): ?>
                      <option selected="selected" value="<?php echo $linea->nCodEst; ?>"><?php echo $linea->cEstado; ?></option>
                      <?php continue?>
                      <?php endif ?>
                      <?php endif ?>
                      <option value="<?php echo $linea->nCodEst; ?>"><?php echo $linea->cEstado; ?></option>
                    <?php endforeach?>
                </select> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-6">
              <label for="">Prioridad:</label>
                <select class="form-control input-sm" name="prioridad">
                    <option value=''>TODOS</option>
                    <?php  foreach($get_prioridadTarea as $linea):?>
                      <?php if(!empty($estado)):?>
                        <?php if($linea->nCodPri==$estado): ?>
                      <option selected="selected" value="<?php echo $linea->nCodPri; ?>"><?php echo $linea->cPrioridad; ?></option>
                      <?php continue?>
                      <?php endif ?>
                      <?php endif ?>
                      <option value="<?php echo $linea->nCodPri; ?>"><?php echo $linea->cPrioridad; ?></option>
                    <?php endforeach?>
                </select>  
            </div>
            <div class="col-md-2 col-xs-6">
              <label for="">validada:</label>
                <select class="form-control input-sm " name="validada">
                    <option value=''>TODOS</option>
                    <option <?php if($validada=='1'){echo "selected";}?> value='1'>SI</option>
                    <option <?php if($validada=='NULL'){echo "selected";}?> value='NULL'>NO</option>
                    
                </select>  
            </div>
            <div class="col-md-2 col-xs-12">
           <label for="">&nbsp</label>
                <div class="form-group">
                  <button type="submit" class="btn  btn-sm btn-primary">
                      <i class="fa fa-search"></i> 
                  </button>
                  <input type="hidden" name="buscar" value="Buscar" class="btn  btn-sm btn-primary">
                  <a href="<?php echo base_url(); ?>/TareasController" title="Limpiar" class="btn btn-sm btn-warning btn-icon rounded-circle mg-r-10 mg-b-10 cursor" onclick="limpiar_table()";>
                    <div><span class="fa fa-eraser" data-icon="ion-add-circle" data-inline="false"></span></div>
                  </a>
                  <button type="button" class="btn  btn-sm btn-success" id="btnGuardarTarea">
                      <i class="fa fa-refresh"></i> 
                  </button>
                </div>  
            </div>
              
          </form>    
          </div>
            </div>
            <form action="" id="formTarea">
          <div class="box-body" >
            <table id="example2" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                  <th>#</th>
                  <th>TAREA</th>
                  <th>AREA</th>
                  <th>TIPO TAREA</th>
                  <th>RESPONSABLE</th>
                  <th>INICIO</th>
                  <th>FIN</th>
                  <th>PRIORIDAD</th>
                  <th>ESTADO</th>
                  <th>Av</th> 
                  <th>V</th>
                </tr>
                </thead>
                <tbody>
              
                <?php  if (!empty($get_tareas)):?>
                                        <?php  foreach($get_tareas as $linea):?>
                                                <tr>
                                                <td><input type="hidden" name="codTarea[]" value="<?php echo $linea->nCodTar; ?>"><input class="checkbok2" type="checkbox"     ></td>
                                                <td class="col-md-3" ><?php echo $linea->cTarea; ?></td>
                                                <td ><?php echo $linea->Descripcion; ?></td>
                                                <td style="font-size:89%;" class="col-md-2"><?php echo $linea->cProyecto; ?></td>
                                                <td style="font-size:89%;" class="col-md-3"><?php echo $linea->cApePat." " ?><?php echo  $linea->cApeMat." " ?><?php echo  $linea->cNombres ?></td>
                                                <td class="col-md-2" ><?php echo $linea->dFecIni; ?></td>
                                                <td class="col-md-2"><?php echo $linea->dFecFin; ?></td>
                                                <td><?php echo $linea->cPrioridad; ?></td>
                                                <td <?php if($linea->nCodEst=='2'){echo "style=background-color:red;color:white"; };?> ><?php echo $linea->cEstado; ?></td>
                                                <td><input name="nAvance2[]"  type="hidden" size="1"  value="<?php echo $linea->nAvance; ?>"><input name="nAvance[]" class="form-control input-sm " type="text" size="1" value="<?php echo $linea->nAvance; ?>"  <?php if($linea->nCodEst=='3' or $linea->nCodEst=='1'){echo "readonly";} ?> onkeypress="return Numeros(event);"></td>
                                                <?php if($linea->bValidada=='1'): ?>
                                                  <td><span class="label label-success pull-right"><i class="fa  fa-check"></i></span></td>
                                                <?php else:?>
                                                  <td><span class="label label-warning pull-right">x</span></td>
                                                <?php endif ?>
                                                
                                                </tr>
                                        <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
            </form>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <div class="modal fade" id="myModalCerrado" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cierre de Transacciones de Revisiones</h4>
        </div>
        <div class="modal-body">
         <div class="row">
         <div class="col-12">
              <div class="col-md-6 col-sm-6"><input type="text" class="form-control pull-right datepicker2" id="FechaInicioCie" name="FechaInicioCie" placeholder="Fecha Inicio" ></div>
              <div class="col-md-6 col-sm-6"><input type="text" class="form-control pull-right datepicker2" id="FechaFinCie" name="FechaFinCie" placeholder="Fecha Fin" ></div>
         </div>
         </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="cerrarRevesiones()" >Guardar </button>
        </div>
      </div>
    </div>
  </div>