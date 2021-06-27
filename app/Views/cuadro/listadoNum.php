  <style>
  .sticky{
      position:sticky;
      left:0;
      background:#E2DDDC;
      color:black;
  }
  .table-scrol{
     overflow-x:auto; 
  }
  
  </style>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container-fluid">
    
      <!-- Main content -->
      <section class="content">
        <div class="box">
          <div class="box-header with-border">
            <form action="<?php echo current_url();?>" method="POST" >
            <div class="row">
            <div class="col-md-2 col-xs-5">
              <div class="form-group">
                    <label for="">Año:</label>
                    <select class="form-control input-sm " name="anio" required>
                        <option value=''>TODOS</option>
                        <?php foreach($Anio as $row):?>
                            <option  <?php if($Anio2==$row->Anio){echo "selected";}?> value='<?php echo $row->Anio?>'><?php echo $row->Anio ?></option>
                        <?php endforeach ?>
                    </select>  
              </div>  
            </div>
            <div class="col-md-2 col-xs-5">
              <div class="form-group">
                    <label for="">Mes:</label>
                    <select class="form-control input-sm " name="mes">
                        <option value=''>TODOS</option>
                        <option <?php if($mes=="1"){echo "selected";}?> value='1'>Enero</option>
                        <option <?php if($mes=="2"){echo "selected";}?> value='2'>Febrero</option>
                        <option <?php if($mes=="3"){echo "selected";}?> value='3'>Marzo</option>
                        <option <?php if($mes=="4"){echo "selected";}?> value='4'>Abril</option>
                        <option <?php if($mes=="5"){echo "selected";}?> value='5'>Mayo</option>
                        <option <?php if($mes=="6"){echo "selected";}?> value='6'>Junio</option>
                        <option <?php if($mes=="7"){echo "selected";}?> value='7'>Julio</option>
                        <option <?php if($mes=="8"){echo "selected";}?> value='8'>Agosto</option>
                        <option <?php if($mes=="9"){echo "selected";}?> value='9'>Septiembre</option>
                        <option <?php if($mes=="10"){echo "selected";}?> value='10'>Obtubre</option>
                        <option <?php if($mes=="11"){echo "selected";}?> value='11'>Noviembre</option>
                        <option <?php if($mes=="12"){echo "selected";}?> value='12'>Diciembre</option>
                    </select> 
              </div>  
            </div>
            <div class="col-md-2 col-xs-5">
              <div class="form-group">
                    <label for="">Cuadro Mando:</label>
                    <select class="form-control input-sm " name="cuadro" required>
                        <option value=''>TODOS</option>
                        <?php foreach($CuadroMando as $row):?> 
                            <option <?php if($cuadro==$row->iCuadro){echo "selected";}?> value='<?php echo $row->iCuadro?>'><?php echo $row->cDescripcion ?></option>
                        <?php endforeach ?>
                    </select> 
              </div>  
            </div>
            <div class="col-md-2 col-xs-12">
            <input type="hidden" name="buscar" value="Buscar">
           <label for="">&nbsp</label>
                <div class="form-group">
                  <button type="submit" class="btn  btn-sm btn-primary">
                      <i class="fa fa-search"></i> 
                  </button>
                  <a href="<?php echo base_url(); ?>/CuadroMandoController" title="Limpiar" class="btn btn-sm btn-warning btn-icon rounded-circle mg-r-10 mg-b-10 cursor" onclick="limpiar_table()";>
                    <div><span class="fa fa-eraser" data-icon="ion-add-circle" data-inline="false"></span></div>
                  </a>
                  <button type="button" class="btn  btn-sm btn-success" id="btnGuardarCuadro">
                      <i class="fa fa-refresh"></i> 
                  </button>
                </div>  
            </div>
            
            </div>
            </form>
          </div>
          <div class="box-body">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#Cuantitativas" data-toggle="tab">Cuantitativas</a></li>
                    <li><a href="#settings" data-toggle="tab">Cualitativas</a></li>
                    </ul>
                    <form action="" id="form_cuantitativas">
                    <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="Cuantitativas">
                    <div class="row">
                    
               
                        <div class="col-md-12">
                            <table id="table_default2" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                <tr> 
                                <th  class="sticky" >Variable</th>
                                <?php if($mes==""):?>
                                <th style="width:60px" >Enero</th>
                                <th style="width:60px">Febrero</th>
                                <th style="width:60px">Marzo</th>
                                <th style="width:60px">Abril</th>
                                <th style="width:60px">Mayo</th>
                                <th style="width:60px">Junio</th>
                                <th style="width:60px">Julio</th>
                                <th style="width:60px">Agosto</th>
                                <th style="width:60px">Septiembre</th>
                                <th style="width:60px">Obtubre</th>
                                <th style="width:60px">Noviembre</th>
                                <th style="width:60px">Diciembre</th>
                                <th style="width:60px">Total</th>
                                <?php else: ?>
                                   
                                    <th><?php echo($messele)?></th>
                                    <th style="width:60px">Total</th>
                                <?php endif ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $a=0;$valorg=0; ?>
                                <?php foreach( $ListadoCuantitativas as $row2):?>
                                    <?php $valor=$row2->idVariable;?>
                                    <?php if($a==0):?>
                                        <tr>
                                        <?php $valorg=$valor?>
                                        <td  style="font-size:85%;" class="sticky "><?php echo $row2->cVariable?><input type="hidden" name="idvariables[]" value="<?php echo $row2->idVariable?>"></td>
                                        <td style='cursor:pointer;font-size:85%;' class='input_cuadro' onclick='accion_cuadro(this,"<?php echo number_format($row2->nValor, 2, ".", "")?>","<?php echo $row2->idVariable?>","<?php echo $row2->iMes?>")'  data-valo='click' ><?php echo number_format($row2->nValor, 2, '.', '')?><input name='val_indi' type='hidden' value='A'/><input type="hidden" name="values_static" value="<?php echo number_format($row2->nValor, 2, '.', '')?>" ><input type="hidden" name="values_static2" value="<?php echo number_format($row2->nValor, 2, '.', '')?>" ></td>
                                        <?php $a=$a+1; ?>
                                    <?php else:?>
                                        <?php if($row2->iMes=='13'):?>
                                            <td style='font-size:85%;' class='input_cuadro'  data-valo='click'><p><?php echo number_format($row2->nValor, 2, '.', '')?></p><input name='val_indi' type='hidden' value='A'/><input type="hidden" name="values_static" value="<?php echo number_format($row2->nValor, 2, '.', '')?>"><input type="hidden" name="values_static_total[]" value="<?php echo number_format($row2->nValor, 2, '.', '')?>"></td>
                                            </tr>
                                            <?php $a=0 ?>
                                        <?php else:?>
                                            <td style='cursor:pointer;font-size:85%;' class='input_cuadro' onclick='accion_cuadro(this,"<?php echo number_format($row2->nValor, 2, ".", "")?>","<?php echo $row2->idVariable?>","<?php echo $row2->iMes?>")' data-valo='click'><?php echo number_format($row2->nValor, 2, '.', '')?><input name='val_indi' type='hidden' value='A'/><input type="hidden" name="values_static" value="<?php echo number_format($row2->nValor, 2, '.', '')?>" ><input type="hidden" name="values_static2" value="<?php echo number_format($row2->nValor, 2, '.', '')?>" ></td>
                                            <?php $a=$a+1; ?>
                                        <?php endif?>
                                    <?php endif?>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 table-scrol">
                                <table id="table_default3" class="table table-bordered table-hover" style="width:100%">
                            
                                   
                                    <thead>
                                    <tr>
                                    <th class="sticky">Variable</th>
                                    <?php if($mes==""):?>
                                        <th style="width:60px" >Enero</th>
                                <th style="width:60px">Febrero</th>
                                <th style="width:60px">Marzo</th>
                                <th style="width:60px">Abril</th>
                                <th style="width:60px">Mayo</th>
                                <th style="width:60px">Junio</th>
                                <th style="width:60px">Julio</th>
                                <th style="width:60px">Agosto</th>
                                <th style="width:60px">Septiembre</th>
                                <th style="width:60px">Obtubre</th>
                                <th style="width:60px">Noviembre</th>
                                <th style="width:60px">Diciembre</th>
                                <th style="width:60px">Total</th>
                                <?php else: ?>
                                   
                                    <th><?php echo($messele)?></th>
                                <?php endif ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $ab=0;$valorg=0; ?>
                                    <?php foreach( $ListadoCualitativas as $row3):?>
                                        <?php $valor=$row3->idVariable;?>
                                    <?php if($ab==0):?>
                                        <tr>
                                        <?php $valorg=$valor?>
                                        <td style="font-size:85%;" class="sticky " ><?php echo $row3->cVariable?></td>
                                        <td style='cursor:pointer;font-size:85%;' class='input_cuadro' onclick='accion_cuadro_cualitativo(this,"<?php echo $row3->cValor?>","<?php echo $row3->idVariable?>","<?php echo $row3->iMes?>")'  data-valo='click'><?php echo $row3->cValor?><input name='val_indi' type='hidden' value='A'/></td>
                                        <?php $ab=$ab+1; ?>
                                    <?php else:?>
                                        <?php if($row3->iMes=='13'):?>
                                            <td style='font-size:85%;' class='input_cuadro'  data-valo='click'><?php echo $row3->cValor?><input name='val_indi' type='hidden' value='A'/></td>
                                            <?php $ab=0 ?>
                                            </tr>
                                        <?php else:?>  
                                            <td style='cursor:pointer;font-size:85%;' class='input_cuadro' onclick='accion_cuadro_cualitativo(this,"<?php echo $row3->cValor?>","<?php echo $row3->idVariable?>","<?php echo $row3->iMes?>")'  data-valo='click'><?php echo $row3->cValor?><input name='val_indi' type='hidden' value='A'/></td>
                                            <?php $ab=$ab+1; ?>
                                        <?php endif ?>
                                    <?php endif?>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                <input type="hidden" name="kak" value="3">
                                </form>
                            </div>
                        </div>  
                    </div>
                    <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
          </div>
        </div>  
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>