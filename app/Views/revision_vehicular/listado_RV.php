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
            <form  method="POST" >
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker1" id="fechaIniRevi" name="FechaInicio" placeholder="Fecha inicio" value="<?php echo !empty($fechaI) ? $fechaI:'';?>">
                </div>
              </div>  
            </div>
            <div class="col-md-2 col-xs-6">
              <div class="form-group">
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker2" id="fechaFinRevi" name="FechaFin" placeholder="Fecha fin" value="<?php echo !empty($fechaF) ? $fechaF:'';?>" required>
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
                <button type="button" class="btn btn-primary" onclick="cargar_table()">
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
            <table id="example32" class="table table-bordered table-striped" style="width:100%">
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