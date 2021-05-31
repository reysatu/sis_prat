$(document).ready(function(){
  var table_rv=$('#example2').DataTable({
    "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "scrollX": true,
        "destroy" : true,
        "processing": true,
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        "bScrollCollapse": true,
        "fixedColumns":   {
        "leftColumns": 1
          },
        "dom":"Bfrtip",
        "buttons":[
          {
            extend: 'print',
            title: 'Reporte de Registro Vehicular',
            orientation: 'landscape',
            pageSize: 'LEGAL'
         },
          {
            extend: 'excel',
            title: 'Reporte de Registro Vehicular',
            orientation: 'landscape',
            pageSize: 'LEGAL'
         },
        ],
        exportOptions: {
        modifer: {
          page: 'all',
          search: 'none'    }
      } , 
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
        },  
        });
  
}); 
$(".checkbok2").click(function(){
  $(".checkbok2").prop("checked", false);
  $(this).prop("checked", true);
});
function editar_rv(){
  nro=$('input:checkbox[name=check]:checked').val();
  if(nro==undefined){
    alerta_validacionedit("Seleccione un registro");
                   return false;
  }else{
    
    window.location.href=baseurl+"Editar/RevisionVehicular/"+nro; 
  }

}
function eliminar_rv(){
  nro=$('input:checkbox[name=check]:checked').val();
  if(nro==undefined){
    alerta_validacionedit("Seleccione un registro");
                   return false;
  }else{
    Swal.fire({
      title: 'Desea eliminar el registro?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Eliminado!',
      '',
      'success'
        );
        window.location.href=baseurl+"Eliminar/RevisionVehicular/"+nro; 
      }
    })
    
  }
}
function alerta_validacionedit(msj){
        Swal.fire({
            icon: "error",
            title: "Error",
            text: msj,
        })

    }

function cerrarRevesiones(){
  Finicio=$("#FechaInicioCie").val();
  Ffin=$("#FechaFinCie").val();
  if(Finicio=="" || Ffin==""){
    $.notify("Campos Requeridos!", "warn",{ position:"top" });
  }else if(Finicio>Ffin){
    $.notify("Rango de Fecha Incorrecto!", "warn",{ position:"top" });
  }else{
    $.ajax({ 
      type:'POST',
      url: baseurl+"RevisionVController/CambiarEstado",
      data:{Finicio:Finicio,Ffin:Ffin},
       success: function(data){
         console.log(data);
         if(data=="T"){
            Swal.fire({
            title: 'Se generó',
            icon: 'success',
            confirmButtonText: 'OK'
            });
            location.reload();
         }else{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Existen Revisones que no poseen los datos completos',
          })

         }
         

       }
      });
  }
}    
// $(document).ready(function(){
//     cargar_table(); 
//      $("#re_placa").change(function(){
//       datatable_placa();
//     });
//     $("#datepicker2").change(function(){
//       datatable_fecha();
//     });
//     $("#datepicker1").change(function(){
//       datatable_fecha();
//     });
//     $("#red_fechaSup").change(function(){
//       val=$("#red_fechaSup").val();
//       $("#red_fechaJef").val(val);
//     });
//  });
// function datatable_fecha(){
//     Fecha_Inicio=$("#datepicker1").val();
//     Fecha_Fin=$("#datepicker2").val();
    
//     if(Fecha_Fin!=""){
//       if(Fecha_Inicio>Fecha_Fin){
//         $.notify("Rango de Fecha Incorrecto!", "warn",{ position:"top" });
//       }else if(Fecha_Inicio==""){
//         $.notify("Rango de Fecha Incorrecto!", "warn",{ position:"top" });
//       }
//     }
//     var table_rv=$('#example2').DataTable({
//       "scrollX": true,
//       "destroy" : true,
//       "processing": true,
//       "serverSide": true,
//       'paging'      : true,
//       'lengthChange': false,
//       'searching'   : true,
//       'ordering'    : true,
//       'info'        : true,
//       'autoWidth'   : true,
//       "bScrollCollapse": true,
//       "fixedColumns":   {
//       "leftColumns": 1
//         },
//         "dom":"Bfrtip",
//         "buttons":[
//           'excel',
//         ],
//         "language":{
//           "sProcessing":     "Procesando...",
//           "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
//           "sZeroRecords":    "No se encontraron resultados",
//           "sEmptyTable":     "Ningún dato disponible en esta tabla",
//           "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//           "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//           "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//           "sInfoPostFix":    "",
//           "sSearch":         "Buscar&nbsp",
//           "sUrl":            "",
//           "sInfoThousands":  ",",
//           "sLoadingRecords": "Cargando...",
//           "oPaginate": {
//               "sFirst":    "Primero",
//               "sLast":     "Último",
//               "sNext":     "Siguiente",
//               "sPrevious": "Anterior"
//           },
//           "oAria": {
//               "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//           }
//       }, 
//         "ajax": {
//           "url":"RevisionVController/get_revision2",
//            "type":"post",
//            "data": {
//             Fecha_Inicio: Fecha_Inicio,Fecha_Fin:Fecha_Fin,
//                       },
//         },
//         "columns": [
             
//               {data:'Fecha'},
//               {data:'Placa'},
//               {data:'Codigo'},
//               {data:'Nro'},
//               {data:'TipoRevision'},
//               {data:'Revision'},
//               {data:'Chofer'},
//               {data:'Supervisor'},
//               {data:'Jefe'},
  
//           ],
//       }); 
//   } 
//  function cargar_table(){
//   var table_rv=$('#example2').DataTable({
//     "scrollX": true,
//     "destroy" : true,
//     "processing": true,
//     "serverSide": true,
//     'paging'      : true,
//     'lengthChange': true,
//     'searching'   : true,
//     'ordering'    : true,
//     'info'        : true,
//     'autoWidth'   : true,
//     "bScrollCollapse": true,
//     "fixedColumns":   {
//     "leftColumns": 1
//       },
//     "dom":"Bfrtip",
//     "buttons":[
//       'excel',
//     ],
//     exportOptions: {
//     modifer: {
//       page: 'all',
//       search: 'none'    }
//   } , 
//       "language":{
//         "sProcessing":     "Procesando...",
//         "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
//         "sZeroRecords":    "No se encontraron resultados",
//         "sEmptyTable":     "Ningún dato disponible en esta tabla",
//         "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//         "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//         "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//         "sInfoPostFix":    "",
//         "sSearch":         "Buscar&nbsp",
//         "sUrl":            "",
//         "sInfoThousands":  ",",
//         "sLoadingRecords": "Cargando...",
//         "oPaginate": {
//             "sFirst":    "Primero",
//             "sLast":     "Último",
//             "sNext":     "Siguiente",
//             "sPrevious": "Anterior"
//         },
//         "oAria": {
//             "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//         }
//     },  
//       "ajax": {
//         "url":"RevisionVController/get_revision",
//          "type":"post",
//       },
//       "columns": [
//         {data: 'Nro', render: function(data, type) {
//           return "<input type='checkbox'>";
        
//         } },
//             {data:'Fecha'},
//             {data:'Placa'},
//             {data:'Codigo'},
//             {data:'Nro'},
//             {data:'TipoRevision'},
//             {data:'Revision'},
//             {data:'Chofer'},
//             {data:'Supervisor'},
//             {data:'Jefe'},

//         ],
//     });
// }
// function datatable_placa(){
//     placa=$("#re_placa").val();
//     if(placa==""){
//       cargar_table();
//       return false;
//     }

//     var table_rv=$('#example2').DataTable({
//       "scrollX": true,
//       "destroy" : true,
//       "processing": true,
//       "serverSide": true,
//       'paging'      : true,
//       'lengthChange': false,
//       'searching'   : true,
//       'ordering'    : true,
//       'info'        : true,
//       'autoWidth'   : true,
//       "bScrollCollapse": true,
//       "fixedColumns":   {
//       "leftColumns": 1
//         },
//         "dom":"Bfrtip",
//         "buttons":[
//           'excel',
//         ],
//         "language":{
//           "sProcessing":     "Procesando...",
//           "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
//           "sZeroRecords":    "No se encontraron resultados",
//           "sEmptyTable":     "Ningún dato disponible en esta tabla",
//           "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//           "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//           "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//           "sInfoPostFix":    "",
//           "sSearch":         "Buscar&nbsp",
//           "sUrl":            "",
//           "sInfoThousands":  ",",
//           "sLoadingRecords": "Cargando...",
//           "oPaginate": {
//               "sFirst":    "Primero",
//               "sLast":     "Último",
//               "sNext":     "Siguiente",
//               "sPrevious": "Anterior"
//           },
//           "oAria": {
//               "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//           }
//       }, 
//         "ajax": {
//           "url":"RevisionVController/get_revision3",
//            "type":"post",
//            "data": {
//             placa: placa,
//                       },
//         },
//         "columns": [
//               {data:'Fecha'},
//               {data:'Placa'},
//               {data:'Codigo'},
//               {data:'Nro'},
//               {data:'TipoRevision'},
//               {data:'Revision'},
//               {data:'Chofer'},
//               {data:'Supervisor'},
//               {data:'Jefe'},
  
//           ],
//       }); 
//   } 