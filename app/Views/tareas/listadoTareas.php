  <!-- Full Width Column -->
  <link rel="stylesheet" href="<?php echo base_url();?>/public/mycss/tarea.css">
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
                  <input type="text" class="form-control input-sm"  id="textbus" name="textbus" placeholder="Buscar" value="<?php echo !empty($textbus) ? $textbus:'';?>"  >
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <label for="">Fecha:</label>
              <div class="form-group">
                  
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control input-sm  datepicker1" id="FechaInicio" name="FechaInicio" placeholder="Fecha inicio" value="<?php echo !empty($fechaI) ? $fechaI:'';?>">
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
                  <input type="text" class="form-control input-sm  datepicker2" id="FechaFin" name="FechaFin" placeholder="Fecha fin" value="<?php echo !empty($fechaF) ? $fechaF:'';?>" >
                </div>
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
              <label for="">Tipo Tarea:</label>
              <select class="form-control input-sm" id="tipoTarea" name="tipoTarea"> 
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
                <select class="form-control input-sm" id="estado" name="estado">
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
                <select class="form-control input-sm" id="prioridad" name="prioridad">
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
                <select class="form-control input-sm " id="validada" name="validada">
                    <option value=''>TODOS</option>
                    <option <?php if($validada=='1'){echo "selected";}?> value='1'>SI</option>
                    <option <?php if($validada=='NULL'){echo "selected";}?> value='NULL'>NO</option>
                    
                </select>  
            </div>
            <div class="col-md-2 col-xs-12">
           <label for="">&nbsp</label>
                <div class="form-group">
                  <button type="button" class="btn  btn-sm btn-primary" onclick="cargar_tableTarea();">
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
            <table id="tableTareaL" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Tarea</th>
                  <th>Area</th>
                  <th>Tipo</th>
                  <th>Responsable</th>
                  <th>Inicio</th>
                  <th>Fin</th>
                  <th>Prioridad</th>
                  <th>Estado</th>
                  <th>Av</th> 
                  <th>V</th>
                </tr>
                </thead>
               
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