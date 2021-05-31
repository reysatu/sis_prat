$(document).ready(function(){
 $("#btn_guardarRv").click(function(){
        if($("#cCodConsecutivo").val()==""){
            $.notify(
                "No seleccionó consecutivo", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_feReg").val()==""){
            $.notify(
                "No seleccionó Fecha de Registro", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_placa").val()==""){
            $.notify(
                "No seleccionó  Placa", 
                { position:"top" }
              );
              return false; 
        }else if($("#select_Chofer").val()==""){
            $.notify(
                "No seleccionó Chofer", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_nRev").val()==""){
            $.notify(
                "No seleccionó Revisión", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_nRev").val()==""){
            $.notify(
                "No seleccionó Revisión", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_tipoRevision").val()==""){
            $.notify(
                "No seleccionó Tipo Revisión", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_supervisor").val()==""){
            $.notify(
                "No seleccionó  Supervisor", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_fechaSup").val()==""){
            $.notify(
                "No seleccionó Fecha Supervisor", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_jefe").val()==""){
            $.notify(
                "No seleccionó  Jefe", 
                { position:"top" }
              );
              return false;  
        }
        $.ajax({ 
            type:'POST',
            url: baseurl+"RevisionVController/guardarRevisionVehicular",
            data:$("#form_RevisionVehicular").serialize(),
             success: function(data){
                console.log(data);
                 if(data=="F"){
                    console.log("BBB");
                    Swal.fire({
                        title: 'Error',
                        text: 'Ya existe una revisión en esa fecha',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                 } else if(data=="D"){
                    Swal.fire({
                        title: 'Error',
                        text: 'No existe primera revisión en esa fecha',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                 }else{
                     console.log("AAAA");
                     console.log("sw");
                        $("#export_Revd").prop('disabled', false);
                        $("#export_pdf").prop('disabled', false);
                    if($("#RV_estado").val()==""){
                        Swal.fire({
                            title: 'Se generó',
                            text: 'Revisión Vehicular N°'+data,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        $("#RV_estadov").val("Abierto");
                        $("#RV_estado").val("1");
                        $("#RV_consecutivo").val(data);
                        $('#cCodConsecutivo').prop('disabled', 'disabled');
                        $('#red_placa').prop('disabled', 'disabled');
                        $('#red_nRev').prop('disabled', 'disabled');
                        $('#red_tipoRevision').prop('disabled', 'disabled');
                        placa=$("#red_placa").val();     
                        tipoRevision=$("#red_tipoRevision").val(); 
                        $.ajax({ 
                            type:'POST',
                            url: baseurl+"RevisionVController/get_NroOrden",
                            data:{placa:placa},
                             success: function(data){
                                valores=eval(data);
                                $('#tableOrden tbody').html("");
                                $.each(valores, function(idx, opt) {
                                    $('#tableOrden').append("<tr><td class='desOrdenModal' onclick=accion4('"+opt.Codigo+","+opt.Descripcion+"') style='cursor:pointer;height:50px !important'><input type='hidden' value="+opt.Codigo+","+opt.Descripcion+">"+opt.Codigo+"</td> <td class='desOrdenModal' onclick=accion4('"+opt.Codigo+","+opt.Descripcion+"') style='cursor:pointer' ><input type='hidden' value='"+opt.Codigo+","+opt.Descripcion+"'>"+opt.Descripcion+"</td> <td class='desOrdenModal' onclick=accion4('"+opt.Codigo+","+opt.Descripcion+"') style='cursor:pointer' ><input type='hidden' value='"+opt.Codigo+","+opt.Descripcion+"'>"+opt.Placa+"</td></tr>");
                                 });
                
                             }
                            });
                   
                        $.ajax({ 
                            type:'POST',
                            url: baseurl+"RevisionVController/get_GroupRevision",
                            data:{tipoRevision:tipoRevision},
                             success: function(data){
                                valores=eval(data);
                                $('#table_default tbody').html("");
                                $.each(valores, function(idx, opt) {
                                    $('#table_default').append("<tr><td><input  type='hidden' value="+opt.nCodRev+">"+opt.cGrupo+
                                    "</td><td><input name='nCodRev[]' type='hidden' value="+opt.nCodRev+"><input name='nCodGrupoRev[]' type='hidden' value="+opt.nCodGrupoRev+">"+ opt.cRevision+"</td><td class='accion_revision' onclick='accion1("+opt.nCodRev+")' style='cursor:pointer'><input type='hidden' value="+opt.nCodRev+"><input class='accion_guardar' name='cCodAccionR[]' type='hidden' value=''><p></p></td><td style='cursor:pointer' class='input_correctivo' onclick='accion2(this)' data-valo='A'><input name='ejemp' type='hidden' value='A'/></td><td> <input name='cCodConsecutivoOS[]' class='Orden_guardar' type='hidden' value=''><p></p></td><td class='nro_orden' style='cursor:pointer' onclick='accion3("+opt.nCodRev+");'><input type='hidden' value="+opt.nCodRev+"><input name='nConsecutivoOS[]' class='NroOrden_guardar' type='hidden' value=''><p>0</p></td></tr>");
                                 });
                
                             }
                            });
                    }else{
                        Swal.fire({
                            title: 'Se generó',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        
                    }

                 }
                
               
             }
            });

       
      });
 $("#btn_EditarRv").click(function(){
        if($("#cCodConsecutivo").val()==""){
            $.notify(
                "No seleccionó consecutivo", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_feReg").val()==""){
            $.notify(
                "No seleccionó Fecha de Registro", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_placa").val()==""){
            $.notify(
                "No seleccionó  Placa", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_Chofer").val()==""){
            $.notify(
                "No seleccionó Chofer", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_nRev").val()==""){
            $.notify(
                "No seleccionó Revisión", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_nRev").val()==""){
            $.notify(
                "No seleccionó Revisión", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_tipoRevision").val()==""){
            $.notify(
                "No seleccionó Tipo Revisión", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_supervisor").val()==""){
            $.notify(
                "No seleccionó  Supervisor", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_fechaSup").val()==""){
            $.notify(
                "No seleccionó Fecha Supervisor", 
                { position:"top" }
              );
              return false; 
        }else if($("#red_jefe").val()==""){
            $.notify(
                "No seleccionó  Jefe", 
                { position:"top" }
              );
              return false; 
        }
        $.ajax({ 
            type:'POST',
            url: baseurl+"RevisionVController/guardarRevisionVehicular",
            data:$("#form_RevisionVehicularEditar").serialize(),
             success: function(data){
                Swal.fire({
                    title: 'Se generó',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });

             }
            });

        // placa=$("#red_placa").val();     
        // tipoRevision=$("#red_tipoRevision").val(); 
        // $.ajax({ 
        //     type:'POST',
        //     url: baseurl+"RevisionVController/get_NroOrden",
        //     data:{placa:placa},
        //      success: function(data){
        //         valores=eval(data);
        //         $('#tableOrden tbody').html("");
        //         $.each(valores, function(idx, opt) {
        //             $('#tableOrden').append("<tr><td class='desOrdenModal' onclick=accion4('"+opt.Codigo+","+opt.Descripcion+"') style='cursor:pointer;height:50px !important'><input type='hidden' value="+opt.Codigo+","+opt.Descripcion+">"+opt.Codigo+"</td> <td class='desOrdenModal' onclick=accion4('"+opt.Codigo+","+opt.Descripcion+"') style='cursor:pointer' ><input type='hidden' value='"+opt.Codigo+","+opt.Descripcion+"'>"+opt.Descripcion+"</td> <td class='desOrdenModal' onclick=accion4('"+opt.Codigo+","+opt.Descripcion+"') style='cursor:pointer' ><input type='hidden' value='"+opt.Codigo+","+opt.Descripcion+"'>"+opt.Placa+"</td></tr>");
        //          });

        //      }
        //     });
   
    //     $.ajax({ 
    //         type:'POST',
    //         url: baseurl+"RevisionVController/get_GroupRevision",
    //         data:{tipoRevision:tipoRevision},
    //          success: function(data){
    //             valores=eval(data);
    //             $('#table_default tbody').html("");
    //             $.each(valores, function(idx, opt) {
    //                 $('#table_default').append("<tr><td><input  type='hidden' value="+opt.nCodRev+">"+opt.cGrupo+
    //                 "</td><td><input name='nCodRev[]' type='hidden' value="+opt.nCodRev+"><input name='nCodGrupoRev[]' type='hidden' value="+opt.nCodGrupoRev+">"+ opt.cRevision+"</td><td class='accion_revision' onclick='accion1("+opt.nCodRev+")' style='cursor:pointer'><input type='hidden' value="+opt.nCodRev+"><input class='accion_guardar' name='cCodAccionR[]' type='hidden' value=''><p></p></td><td style='cursor:pointer' class='input_correctivo' onclick='accion2(this)' data-valo='A'><input name='ejemp' type='hidden' value='A'/></td><td> <input name='cCodConsecutivoOS[]' class='Orden_guardar' type='hidden' value=''><p></p></td><td class='nro_orden' style='cursor:pointer' onclick='accion3("+opt.nCodRev+");'><input type='hidden' value="+opt.nCodRev+"><input name='nConsecutivoOS[]' class='NroOrden_guardar' type='hidden' value=''><p></p></td></tr>");
    //              });

    //          }
    //         });
      });     
      
});

$("#guardar_Revd").click(function(){
    if( $('#checkblanco').prop('checked') ) {
        $(".accion_revision").each(function(){
            valoracc=$(this).children("input[name='cCodAccionR[]']").val();
            if(valoracc==''){
                $(this).children("input[name='cCodAccionR[]']").val("OK");
                $(this).children("p").text('OK');
            }
        });
    };
    cCodConsecutivo=$("#cCodConsecutivo").val();
    nConsecutivo=$("#RV_consecutivo").val();
    nCodTipRev=$("#red_tipoRevision").val();
    nCodRev=$('input[name="nCodRev[]"]').map(function(){return $(this).val();}).get();
    nCodGrupoRev=$('input[name="nCodGrupoRev[]"]').map(function(){return $(this).val();}).get();
    cCodAccionR=$('input[name="cCodAccionR[]"]').map(function(){return $(this).val();}).get();
    cAccionCorr=$('input[name="cAccionCorr[]"]').map(function(){return $(this).val();}).get();
    cCodConsecutivoOS=$('input[name="cCodConsecutivoOS[]"]').map(function(){return $(this).val();}).get();
    nConsecutivoOS=$('input[name="nConsecutivoOS[]"]').map(function(){return $(this).val();}).get();
    $.ajax({ 
        type:'POST',
        url: baseurl+"RevisionVController/guardarReVehDet",
         data:{cCodConsecutivo:cCodConsecutivo,nConsecutivo:nConsecutivo,nCodTipRev:nCodTipRev,nCodRev:nCodRev,nCodGrupoRev:nCodGrupoRev,
            cCodAccionR:cCodAccionR,cAccionCorr:cAccionCorr,cCodConsecutivoOS:cCodConsecutivoOS,nConsecutivoOS:nConsecutivoOS,},
         success: function(data){
             console.log(data);
            Swal.fire({
                title: 'Se generó',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
        });
  })