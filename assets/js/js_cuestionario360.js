"use strict";
$(document).ready(function() {
  $("#readysaveEvaluacion360Directivo").prop("disabled", true);
});

$(".editbtn").on("click", function() {
  $tr = $(this).closest("tr");
  var datos = $tr.children("td").map(function() {
    return $(this).text();
  });
  $("#editid").val(datos[0]);
  $("#nameid").val(datos[1]);
  $("#idestatus").val(datos[2]);
});

function countPuntos() {
  let countPuntosTec = 0; /* CONTADOR DE PUNTOS  */
  let arregloTec = [];
  let totalPreguntasTec = $("#totalPreguntasTec").val();
  let calif360user = $("#calif360user").val();
  var preguntasFaltantes360Directivo = false;
  let maxPuntosTec = totalPreguntasTec * 4;
  var califCap = parseFloat($("#calificaconCapF").val());

  for (let i = 0; i < totalPreguntasTec; i++) {
    let idPreguntaTec = $("#idptec" + i).val();
    let valorRTec = $(
      "input:radio[name=preguntaTec" + idPreguntaTec + "]:checked"
    ).val();
    if (isNaN(valorRTec)) {
      Swal.fire({
        icon: "warning",
        confirmButtonColor: "#213c6d",
        title: "DEBES RESPONDER TODAS LAS PREGUNTAS!",
        text:
          "Una de las Preguntas no las has seleccionado porfavor verificalo!",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEnterKey: false,
        allowEscapeKey: false,
        timer: 3500
      });
      preguntasFaltantes360Directivo = true;
    }
    countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
    let objtec = {
      idPreguntaTecr: idPreguntaTec,
      respTec: valorRTec
    };
    arregloTec.push(objtec);
  }
  let totalPuntosTec = countPuntosTec;

  /* CALIFICACION DE LAS COMPETENCIAS TECNICAS DE LOS 360 */
  let calf1 = totalPuntosTec * 0.4 / maxPuntosTec;
  calf1 = Math.floor(calf1 * 1000) / 1000;
  calf1 = parseFloat(calf1);

  /* CALIFICACION DE LA Evaluacion360 */
  let calf2 = calif360user * 0.5;
  calf2 = Math.floor(calf2 * 1000) / 1000;
  calf2 = parseFloat(calf2);

  let califpreliminarTec = calf1 * 10;
  let calificacion = califpreliminarTec + calf2;

  if (calificacion > 10) {
    calificacion = 10;
  } else {
    calificacion = calificacion;
  }

  if (isNaN(calificacion)) {
    $("#totalPuntos2").val(0);
    preguntasFaltantes360Directivo = true;
  } else {
    calificacion = calificacion + califCap;
    calificacion = Math.trunc(calificacion * 100) / 100;

    var showcalf1 = calf1 * 10;
    showcalf1 = Math.trunc(showcalf1 * 100) / 100;
    showcalf1 = showcalf1.toFixed(2);

    $("#califTecR").val(showcalf1);
    $("#califCapacit").val(califCap);
    $("#totalPuntos2").val(calificacion);

    /* VALIDACION PARA GUARDAR CALIFICACION */
    if (preguntasFaltantes360Directivo == false && !isNaN(calificacion)) {
      $("#totalPuntos2").val(calificacion);
      $("#readysaveEvaluacion360Directivo").prop("disabled", false);
    }
  }
}

function guardarRespuestas() {
  let countPuntosTec = 0;
  let arreglo = []; /* arreglo de respuestas */
  let arregloTec = []; /* arreglo de repuestas Tecnicas */
  let totalPreguntasTec = $("#totalPreguntasTec").val();
  let compromisos = $("#compromisos").val();
  let capacitacion = $("#capacitacion").val();
  let periodo = $("#idperiodo").val();
  var califCap = parseFloat($("#calificaconCapF").val());

  /* OBTENEMOS LAS RESPUESTAS DE BLOQUE DE COMPETENCIAS TECNICAS */
  for (let i = 0; i < totalPreguntasTec; i++) {
    let idPreguntaTec = $("#idptec" + i).val();
    let competenciatec = $("#competenciatec" + i).val();
    let valorRTec = $(
      "input:radio[name=preguntaTec" + idPreguntaTec + "]:checked"
    ).val();
    countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
    let objtec = {
      idPreguntaTecr: idPreguntaTec,
      competenciatec: competenciatec,
      respTec: valorRTec
    };
    arregloTec.push(objtec);
  }
  /* console.log(countPuntos); */
  /* TOTAL DE PUNTOS */
  let idUsuario = $("#idEmpleado").val();
  let evalua360 = $("#evalua360").val();
  let tipoevaluacion = $("#tipoevaluacion").val();
  let autoevalua = $("#autoevalua").val();
  let calif360user = $("#calif360user").val();
  let totalPuntosTec = countPuntosTec;
  let totalrespTec = arregloTec.length;

  /* objeto que se envia */
  let objtUser = {
    idusuario: idUsuario,
    calif360user: calif360user,
    tipoevaluacion: tipoevaluacion,
    totalPuntosTec: totalPuntosTec,
    totalrespTec: totalrespTec,
    respuestasTec: arregloTec,
    compromisos: compromisos,
    capacitacion: capacitacion,
    evalua360: evalua360,
    periodo: periodo,
    califCap: califCap
  };
  var url = location.origin;
  var path = window.location.pathname;
  console.log(objtUser);
  $.post(
    "config/helpers/guardarEvaluacionUsuariOperativo360.php",
    {
      objtUseR: objtUser
    },
    function(mensaje) {
      Swal.fire({
        icon: "success",
        confirmButtonColor: "#213c6d",
        title: "Evaluacion Guardada!",
        text: "La evaluacion se ha guardado CORRECTAMENTE!",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEnterKey: false,
        allowEscapeKey: false,
        timer: 2230
      });
      setTimeout(function() {
        window.location.href =
          url + path + "?controller=evausuario&action=index";
      }, 2250);
    }
  );
}

function ajusteCalifCapacitacion(califEva) {
  var califEva = parseFloat(califEva);
  var califCap = parseFloat($("#calificaconCapF").val());

  var califEvaPeriodoFinal = califEva - 1;
  califEvaPeriodoFinal = califEvaPeriodoFinal + califCap;

  return califEvaPeriodoFinal.toFixed(2);
}
