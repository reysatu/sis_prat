$("#btnGuardarCuadro").click(function(){
    if($("#identCuadro").val()!=undefined){
       $.ajax({
        type: "POST",
        data:$("#form_cuantitativas").serialize(),
        url: baseurl+"CuadroMandoController/actualizarCuadro",
        success:function(res){
          console.log(res);
       if(res=="A"){
            Swal.fire({
                title: 'Los indicadores se actualizaron',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            location.reload();
       }else{
        Swal.fire({
            title: 'Error',
            text: 'Ocurrió un error',
            icon: 'error',
            confirmButtonText: 'OK'
        });
       }
       
  
     }
     })
    }
    
} );

function accion_cuadro(e,valor,idvariable,iMes){
    identdata=$(e).children("input").val();
    if(identdata=='A'){
      $(e).html("<input type='text' class='form-control input-sm' size='1' onkeypress='return Numeros_otro(event);' onkeyup='sumar_fila(this)' name='value_cuant[]'  id='accionCorrectivo_agregar' value="+valor+" /><input type='hidden' name='id_cuant[]' value="+idvariable+"  ><input type='hidden'id='identCuadro' name='mes_cuant[]' value="+iMes+"><input type='hidden' name='values_static' value="+valor+" ><input type='hidden' name='values_static2' value="+valor+" >")
    }
  }
  function accion_cuadro_cualitativo(e,valor,idvariable,iMes){
    console.log()
    identdata=$(e).children("input").val();
    if(identdata=='A'){
      $(e).html("<input type='text' class='form-control input-sm' size='1' onkeypress='return Letras_numeros(event);'  onkeyup='sumar_fila(this)' name='value_cualit[]'   value="+valor+" /><input type='hidden' name='id_cualit[]' value="+idvariable+"><input type='hidden'id='identCuadro' name='mes_cualit[]' value="+iMes+"><input type='hidden' name='values_static' value="+valor+" ><input type='hidden' name='values_static2' value="+valor+" >")
    }
  }
  function sumar_fila(e){
    var rows = $("#table_default2").dataTable().fnGetNodes();
    val_actual=$(e).val();
    $(e).siblings('input:hidden[name=values_static]').val(val_actual);
    var fila4 = $("#table_default2 tr").find("td:eq(3)").find('input:hidden[name=values_static]').val();
    if(fila4==undefined){
       $('#table_default2 tr').each(function () {
        var static = $(this).find("td").eq(1).find("input:hidden[name='values_static2']").val();
        var fila1 = $(this).find("td").eq(1).find('input:hidden[name=values_static]').val();
        var fila2 = $(this).find("td").eq(2).find('input:hidden[name=values_static]').val();
        var total=Number(fila2)-Number(static)+Number(fila1);
        total=total.toFixed(2);
        $(this).find("td:eq(2)").children("p").text(total);
        var fila12 = $(this).find("td").eq(2).find("input:hidden[name='values_static_total[]']").val(total);
      });
    }else{
    $('#table_default2 tr').each(function () {
        var fila1 = $(this).find("td").eq(1).find('input:hidden[name=values_static]').val();
        var fila2 = $(this).find("td").eq(2).find('input:hidden[name=values_static]').val();
        var fila3 = $(this).find("td").eq(3).find('input:hidden[name=values_static]').val();
        var fila4 = $(this).find("td").eq(4).find('input:hidden[name=values_static]').val();
        var fila5 = $(this).find("td").eq(5).find('input:hidden[name=values_static]').val();
        var fila6 = $(this).find("td").eq(6).find('input:hidden[name=values_static]').val();
        var fila7 = $(this).find("td").eq(7).find('input:hidden[name=values_static]').val();
        var fila8 = $(this).find("td").eq(8).find('input:hidden[name=values_static]').val();
        var fila9 = $(this).find("td").eq(9).find('input:hidden[name=values_static]').val();
        var fila10 = $(this).find("td").eq(10).find('input:hidden[name=values_static]').val();
        var fila11 = $(this).find("td").eq(11).find('input:hidden[name=values_static]').val();
        var fila12 = $(this).find("td").eq(12).find('input:hidden[name=values_static]').val();
        var fila13=Number(fila1)+Number(fila2)+Number(fila3)+Number(fila4)+Number(fila5)+Number(fila6)+Number(fila7)+Number(fila8)+Number(fila9)+Number(fila10)+Number(fila11)+Number(fila12);
        fila13=fila13.toFixed(2);
        $(this).find("td:eq(13)").children("p").text(fila13);
        var fila12 = $(this).find("td").eq(13).find("input:hidden[name='values_static_total[]']").val(fila13);
      });
  }
  }