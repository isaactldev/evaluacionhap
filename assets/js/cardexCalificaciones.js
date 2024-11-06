$(document).ready(function() {
  var url = location.origin;
  var path = window.location.pathname;
  var fechaCardex = $("#fechaCardex").val();
  var funcion = "verCardex";
  var table = $("#crudCardex").DataTable({
    processing: true,
    stateSave: true,
    ajax: {
      url: "config/helpers/cargarCardex.php",
      method: "POST",
      data: {
        funcion: funcion,
        fechaCardex: fechaCardex
      },
      dataSrc: "data"
    },
    columns: [
      {
        data: "noempleado"
      },
      {
        data: "nombrecompleto"
      },
      {
        data: "nombrepuesto"
      },
      {
        data: "depnombre"
      },
      {
        data: "cp1"
      },
      {
        data: "cp2"
      },
      {
        data: ""
      },
      {
        data: "tipoevaluacion"
      },
      {
        data: "status"
      },
      {
        data: "FECHAEVA"
      }
    ],

    columnDefs: [
      {
        /* CALIFICACION PERIODO 1 */
        targets: [4],
        data: "cp1",
        render: function(data, type, row) {
          if (data == null) {
            return '<a><span class="badge bg-light text-dark">0</span></a>';
          } else
            return (
              '<a id="verEvaluacion1"><span class="badge bg-light text-dark">' +
              data +
              "</span></a>"
            );
        }
      },
      {
        /* CALIFICACION PERIODO 2 */
        targets: [5],
        data: "cp2",
        render: function(data, type, row) {
          if (data == null) {
            return '<a><span class="badge bg-light text-dark">0</span></a>';
          } else
            return (
              '<a id="verEvaluacion2" ><span class="badge bg-light text-dark">' +
              data +
              "</span></a>"
            );
        }
      },
      {
        /* PROMEDIO */
        targets: [6],
        data: null,
        defaultContent: `<a><span class="badge bg-light text-dark">0</span></a>`,
        render: function(data, type, row) {
          if (row.cp1 != null && row.cp2 == null) {
            return (
              '<a><span class="badge bg-light text-dark">' +
              row.cp1 +
              "</span></a>"
            );
          } else if (row.cp1 == null && row.cp2 != null) {
            return (
              '<a><span class="badge bg-light text-dark">' +
              row.cp2 +
              "</span></a>"
            );
          } else if (row.cp1 != null && row.cp2 != null) {
            let promedio = (parseInt(row.cp1) + parseInt(row.cp2)) / 2;
            return (
              '<a><span class="badge bg-light text-dark">' +
              promedio +
              "</span></a>"
            );
          }
        }
      },
      {
        /* status */
        targets: [8],
        data: "status",
        render: function(data, type, row) {
          if (data == "ACTIVO") {
            return '<span class="badge bg-success">ACTIVO</span>';
          } else return '<span class="badge bg-danger">INACTIVO</span>';
        }
      }
    ],

    responsive: true,
    autowdith: false,

    language: {
      lengthMenu: "Ver _MENU_ por pagina",
      zeroRecords:
        "SIN INFORMACION POR MOSTRAR! - Agrega informacion al catalogo",
      info: "Pagina _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(Filtrado por _MAX_ registros totales)",
      search: "Buscar:",
      paginate: {
        next: "Siguiente",
        previous: "Anterior"
      },
      loadingRecords: "CARGANDO..."
    },
    dom: "Bfrtilp",
    buttons: {
      dom: {
        button: {
          className: "btn"
        }
      },
      buttons: [
        {
          extend: "excel",
          title: "CARDEX DE CALIFICACIONE " + fechaCardex,
          text: '<i class="fas fa-file-excel"></i> Exportar Excel',
          className: "btn btn-success",
          excelStyles: {
            template: "blue_medium"
          }
        }
      ]
    }
  });
  table.buttons().container().appendTo("#crud_wrapper .col-md-6:eq(0)");

  /* FUNCION PARA VER EL REPORTE DE CALIFICACIONES DEL USUARIO */
  $("#crudResultados tbody").on("click", "#verReporte", function() {
    let data = table.row($(this).parents()).data();
    var url = location.origin;
    var path = window.location.pathname;

    let idusuario = data.idusuario;
    /* console.log(idusuario); */

    window.location.href =
      url +
      path +
      "?controller=evaluacion&action=getReporteEvaluacionByUser&user=" +
      idusuario +
      "";
  });
});
