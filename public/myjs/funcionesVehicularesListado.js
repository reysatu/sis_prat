$(document).ready(function () {

  cargar_table();
  cargar_tableTarea();
  var table_rv = $('#example2').DataTable({
    "dom": '<"top"i>rt<"bottom"flp><"clear">',
    "scrollX": true,
    "destroy": true,
    "processing": true,
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true,
    "bScrollCollapse": true,
    "fixedColumns": {
      "leftColumns": 1
    },
    "dom": "Bfrtip",
    "buttons": [
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
        search: 'none'
      }
    },
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrando &nbsp _MENU_ &nbsp registros por página",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar&nbsp",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
  });
  var table_rv = $('#exampleTarea').DataTable({
    "dom": '<"top"i>rt<"bottom"flp><"clear">',
    "scrollX": true,
    "destroy": true,
    "processing": true,
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true,
    "bScrollCollapse": true,
    "fixedColumns": {
      "leftColumns": 1
    },
    "dom": "Bfrtip",
    "buttons": [
      {
        extend: 'print',
        title: 'Reporte de tarea',
        orientation: 'landscape',
        pageSize: 'LEGAL'
      },
      {
        extend: 'excel',
        title: 'Reporte de tarea',
        orientation: 'landscape',
        pageSize: 'LEGAL'
      },
    ],
    exportOptions: {
      modifer: {
        page: 'all',
        search: 'none'
      }
    },
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrando &nbsp _MENU_ &nbsp registros por página",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar&nbsp",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
  });

});

function checkSelec(e) {
  $(".checkbok2").prop("checked", false);
  $(e).prop("checked", true);
}
$(".checkbok2").click(function () {
  $(".checkbok2").prop("checked", false);
  $(this).prop("checked", true);
});
function editar_rv() {
  nro = $('input:checkbox[name=check]:checked').val();
  if (nro == undefined) {
    alerta_validacionedit("Seleccione un registro");
    return false;
  } else {

    window.location.href = baseurl + "Editar/RevisionVehicular/" + nro;
  }

}
function eliminar_rv() {
  nro = $('input:checkbox[name=check]:checked').val();
  if (nro == undefined) {
    alerta_validacionedit("Seleccione un registro");
    return false;
  } else {
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
        window.location.href = baseurl + "Eliminar/RevisionVehicular/" + nro;
      }
    })

  }
}
function alerta_validacionedit(msj) {
  Swal.fire({
    icon: "error",
    title: "Error",
    text: msj,
  })

}

function cerrarRevesiones() {
  Finicio = $("#FechaInicioCie").val();
  Ffin = $("#FechaFinCie").val();
  if (Finicio == "" || Ffin == "") {
    $.notify("Campos Requeridos!", "warn", { position: "top" });
  } else if (Finicio > Ffin) {
    $.notify("Rango de Fecha Incorrecto!", "warn", { position: "top" });
  } else {
    $.ajax({
      type: 'POST',
      url: baseurl + "RevisionVController/CambiarEstado",
      data: { Finicio: Finicio, Ffin: Ffin },
      success: function (data) {
        console.log(data);
        if (data == "T") {
          Swal.fire({
            title: 'Se generó',
            icon: 'success',
            confirmButtonText: 'OK'
          });
          location.reload();
        } else {
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
function cargar_table() {
  fechaIniRevi = $("#fechaIniRevi").val();
  fechaFinRevi = $("#fechaFinRevi").val();
  re_placa = $("#re_placa").val();
  var table_rv = $('#example32').DataTable({
    "scrollX": true,
    "destroy": true,
    "processing": true,
    "serverSide": true,
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true,
    "bScrollCollapse": true,
    "fixedColumns": {
      "leftColumns": 1
    },
    "dom": "Bfrtip",
    "buttons": [
      {
        "extend": 'excel',
        "titleAttr": 'Excel',
        "action": newexportaction
      },
      {
        "extend": 'print',
        "titleAttr": 'print',
        "action": newexportaction
      },

    ],
    exportOptions: {
      modifer: {
        page: 'all',
        search: 'none'
      }
    },
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrando &nbsp _MENU_ &nbsp registros por página",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar&nbsp",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    "ajax": {
      "url": "RevisionVController/get_revision",
      "type": "post",
      "data": {
        fechaIniRevi: fechaIniRevi,
        fechaFinRevi: fechaFinRevi,
        re_placa: re_placa,

      },
    },
    "columns": [
      {
        render: function (data, type, full, meta) {
          return "<td><input class='checkbok2' onclick='checkSelec(this)' type='checkbox'  name='check' value='" + full.Nro + "' id='delcheck_" + full.Nro + "'  ></td>";
        }
      },
      { data: 'Fecha' },
      { data: 'Placa' },
      { data: 'Codigo' },
      { data: 'Nro' },
      { data: 'TipoRevision' },
      { data: 'Revision' },
      { data: 'Chofer' },
      { data: 'Supervisor' },
      { data: 'Jefe' },
      {
        render: function (data, type, full, meta) {
          if (full.Estado == "1") {
            estadorv = "Abierto";
          } else {
            estadorv = "Cerrado";
          }
          return '<td >' + estadorv + '</td>';
        }
      },

    ],
  });
}
function cargar_tableTarea() {
    fechaI=$('#FechaInicio').val();
		fechaF=$('#FechaFin').val();
		textbus=$('#textbus').val();
		tipoTarea=$('#tipoTarea').val();
		estado=$('#estado').val();
		prioridad=$('#prioridad').val();
		validada=$('#validada').val();
    var table_rv = $('#tableTareaL').DataTable({
    "scrollX": true,
    "destroy": true,
    "processing": true,
    "serverSide": true,
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true,
    "bScrollCollapse": true,
    "fixedColumns": {
      "leftColumns": 1
    },
    "dom": "Bfrtip",
    "buttons": [
      {
        "extend": 'excel',
        "titleAttr": 'Excel',
        "action": newexportaction
      },
      {
        "extend": 'print',
        "titleAttr": 'print',
        "action": newexportaction
      },

    ],
    exportOptions: {
      modifer: {
        page: 'all',
        search: 'none'
      }
    },
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrando &nbsp _MENU_ &nbsp registros por página",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar&nbsp",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    "ajax": {
      "url": "TareasController/get_TareasTable",
      "type": "post",
      "data": {
        fechaI: fechaI,
        fechaF: fechaF,
        textbus: textbus,
        tipoTarea: tipoTarea,
        estado: estado,
        prioridad: prioridad,
        validada: validada,
      },
    },
    "columns": [
      {
        render: function (data, type, full, meta) {
          return "<td><input type='hidden' name='codTarea[]' value='"+full.nCodTar+"'><input class='checkbok2' type='checkbox'   onclick='checkSelec(this)'  ></td>";
        }
      },
      { data: 'Tarea' },
      { data: 'Area' },
      { data: 'Tipo' },
      { data: 'Responsable' },
      { data: 'Inicio' },
      { data: 'Fin' },
      { data: 'Prioridad' },
      {
        render: function (data, type, full, meta) {
          estilo="EstadoTeR";
          if(full.nCodEst=='2'){
            estilo="EstadoProceso";
          }
          return "<div class='"+estilo+"'  >"+full.Estado+"</div>";
        }
      },
      { 
        render: function (data, type, full, meta) {
          bloq="";
          Av=full.Av;
         if(full.nCodEst=='1' || full.nCodEst=='3' ){
            bloq="readonly";
         }
        
         return "<td><input name='nAvance2[]'  type='hidden' size='1'  value="+Av+"><input name='nAvance[]' class='form-control input-sm' type='text' size='1' value="+Av+" onkeypress='return Numeros(event);' "+bloq+" ></td>";
      } 
    
    },
      {
        render: function (data, type, full, meta) {
          clase="fa fa-close ";
          if(full.V=="1"){
            clase="fa fa-check colCheck";
          }
          return "<td ><i class='"+clase+"' ></i></td>";
        }
      },

    ],
  });
}
function newexportaction(e, dt, button, config) {
  var self = this;
  var oldStart = dt.settings()[0]._iDisplayStart;
  dt.one('preXhr', function (e, s, data) {
    // Just this once, load all data from the server...
    data.start = 0;
    data.length = 2147483647;
    dt.one('preDraw', function (e, settings) {
      // Call the original action function
      if (button[0].className.indexOf('buttons-copy') >= 0) {
        $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-excel') >= 0) {
        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
          $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
          $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-csv') >= 0) {
        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
          $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
          $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
          $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
          $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
      } else if (button[0].className.indexOf('buttons-print') >= 0) {
        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
      }
      dt.one('preXhr', function (e, s, data) {
        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
        // Set the property to what it was before exporting.
        settings._iDisplayStart = oldStart;
        data.start = oldStart;
      });
      // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
      setTimeout(dt.ajax.reload, 0);
      // Prevent rendering of the full data to the DOM
      return false;
    });
  });
  // Requery the server with the new one-time export settings
  dt.ajax.reload();
}