baseurl="http://localhost:90/sis_pract/";
function reportExcel(){
  nro=$("#RV_consecutivo").val();
  window.location.href=baseurl+"ReporteRevisionVehicular/exportexcelRV/"+nro; 
}
function printPDF(){
  nro=$("#RV_consecutivo").val();
  BASE=baseurl+"ReporteRevisionVehicular/printPDF/"+nro; 
  window.open(BASE, '_blank');
}
$(document).ready(function(){
  var table = $('#example222').DataTable( {
  
    scrollX: true,
     
        paging      : false,
        lengthChange: false,
        searching   : true,
        ordering    : false,
        info    : false,
        
        
       
    
} );
  cargar_table_default();
  $("#select_Chofer").change(function(){
    selectconsecutivo=$("#select_Chofer").val();
    $("#red_Chofer").val(selectconsecutivo);
   
  });
  
    $("#red_placa").change(function(){
      placa=$("#red_placa").val();
      fecha=$("#red_feReg").val();
      buscar_chofer(placa,fecha);
      buscar_tipo_revision(placa);
    });
    
  $(".codAccionModal").click(function(){
    valcampo=$(this).children("input").val()
    valu=$("#indent").val()
    addAccionModal(valcampo,valu);
  });
  $(".desAccionModal").click(function(){
    valu=$("#indent").val()
    valcampo=$(this).children("input").val()
    addAccionModal(valcampo,valu);
  });
  $(".desAccionModal").click(function(){
    valu=$("#indent").val()
    valcampo=$(this).children("input").val()
    addAccionModal(valcampo,valu);
  });
 });
 
 function addOrdenModal(valcampo,valu){
   val=valcampo.split(",");
   val1=val[0];
   val2=val[1];
   $("#table_default tr").each(function(){
    valfila=$(this).find("td").slice(0,1).children("input").val();
    if(valu==valfila){
      $(this).find("td:eq(4)").children("p").text(val1);
      $(this).find("td:eq(4)").children(".Orden_guardar").val(val1);
      $(this).find("td:eq(5)").children("p").text(val2);
      $(this).find("td:eq(5)").children(".NroOrden_guardar").val(val2);
    }
   }) 
   $("#modal_orden").modal('hide');  
}
 function addAccionModal(valcampo,valu){
   $("#table_default tr").each(function(){
    valfila=$(this).find("td").slice(0,1).children("input").val();
    if(valu==valfila){
      $(this).find("td:eq(2)").children("p").text(valcampo);
      $(this).find("td:eq(2)").children(".accion_guardar").val(valcampo);
    }
   })
  $("#accion_modal").modal('hide');
 }

 function buscar_tipo_revision(placa){
  $.ajax({ 
    type:'POST',
    url: baseurl+"RevisionVController/get_tipo_revision",
    data:{placa:placa},
    success: function(e){
          data=eval(e);
          $("#red_tipoRevision").html("<option selected='selected' value=''>Seleccione </option>");
          $.each(data,function(key, registro) {
            $("#red_tipoRevision").append('<option value='+registro.nCodTipRev+'>'+registro.cTipoRevision+'</option>');
           });   
          
        }
  
    });
 }
 function limpiar_table(){
  cargar_table();
  $("#datepicker1").val("");
  $("#datepicker2").val("");
 }
 function buscar_chofer(placa,fecha){
  $.ajax({ 
    type:'POST',
    url: baseurl+"RevisionVController/get_chofer",
    data:{placa:placa,fecha:fecha},
    success: function(e){
        if (e=="N"){
          $.notify(
            "No se encontró chofer asignado en la fecha indicada",'warn',
            { position:"top" }
          );
         $('#select_Chofer').val($('#select_Chofer > option:first').val());
         $('#select_Chofer').trigger('change')
         $("#select_Chofer").prop('disabled', false);
        }else{
          data=eval(e);
          chofer=data[0]["cCodEmp"]+" "+data[0]["Descripcion"];
          codigo=data[0]["cCodEmp"];
          $('#red_Chofer').val(codigo);
          $('#select_Chofer').val(codigo);
          $('#select_Chofer').trigger('change')
          $("#select_Chofer").prop('disabled', true);
        }
    }
    });
 }
 
  function accion1(valfilaU){
    valfilaU=valfilaU;
    $("#indent").val(valfilaU);
    $('#accion_modal').modal({
      show: 'true'
  }); 
  }
  function accion2(e){
    identdata=$(e).children("input").val();
    if(identdata=='A'){
      $(e).html("<input type='text' name='cAccionCorr[]' id='accionCorrectivo_agregar' value='' />")
    
    }
   
  }
  
  // function accion3(valfilaU){
  //   valfilaU=valfilaU;
  //     $("#indent_orden").val(valfilaU);
  //   $('#modal_orden').modal({
  //     show: 'true'
  //   }); 
  // }
   function accion3(valfilaU){
  valfilaU=valfilaU;
    $("#indent_orden").val(valfilaU);
       $("#table_default tr").each(function(){
        valu=$(this).find("td").slice(0,1).children("input").val();
  if(valu==valfilaU){
    accion=$(this).find("td:eq(2)").children("input[name='cCodAccionR[]']").val();
    if(accion=="F"){
    $('#modal_orden').modal({
      show: 'true'
    }); 
    }
  }
 }) 
 
}
  function accion4(val){
    valcampo=val;
    valu=$("#indent_orden").val();
    addOrdenModal(valcampo,valu);
  }
  
  

  function cargar_table_default(){
    var table_rv=$('#table_default').DataTable({
      "scrollX": true,
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      
      "bScrollCollapse": true,
      "fixedColumns":   {
      "leftColumns": 1
        },
        "language":{
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar&nbsp",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
      } 
      });
     
      var table_rv=$('#table_default2').DataTable({
        "scrollX": true,
     
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : true,
        
        "scrollCollapse": true,
          "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar&nbsp",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        } 
        });
        var table_rv=$('#table_default3').DataTable({
         
     
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : true,
          
          "scrollCollapse": true,
            "language":{
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar&nbsp",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          } 
          });    
  }
 