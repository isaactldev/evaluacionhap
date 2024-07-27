"use strict";
/* DESABILITAMOS EL BOTON DE GUARDAR */
$(document).ready(function() {
  $("#readysaveEvaluacion").prop("disabled", true);
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
  let countPuntos = 0; /* CONTADOR DE PUNTOS  */
  let countPuntosTec = 0;
  let arregloTec = [];
  let totalPreguntas = $("#totalPreguntas").val();
  let totalPreguntasTec = $("#totalPreguntasTec").val();
  let maxPuntosTec = totalPreguntasTec * 4;
  var preguntasFaltantes = false;

  for (let i = 0; i < totalPreguntas; i++) {
    let idPregunta = $(
      "#idp" + i
    ).val(); /* console.log("idPregunta"+idPregunta); */
    let valorR = $(
      "input:radio[name=pregunta" + idPregunta + "]:checked"
    ).val();

    if (isNaN(valorR)) {
      Swal.fire({
        icon: "warning",
        confirmButtonColor: "#213c6d",
        showConfirmButton: false,
        title: "FALTAN PREGUNTAS POR CONTESTAR!",
        text:
          "Una de las preguntas aun esta sin responder porfavor verificalo!",
        allowOutsideClick: false,
        allowEnterKey: false,
        allowEscapeKey: false,
        timer: 3500
      });
      preguntasFaltantes = true;
    }
    countPuntos = parseFloat(valorR) + parseFloat(countPuntos);
  }

  let totalPuntos = countPuntos;
  let maxPuntosG = totalPreguntas * 4;

  /* CALCULO DE CALIFICACION ENFERMERAS */
  let calf1 = totalPuntos * 0.6 / maxPuntosG;

  /* SI EXISTE CALIFICACION DEL ANECDOTARIO */
  if ($("#califAnecdotario").length) {
    let califTec = parseFloat($("#califAnecdotario").val());

    let calf1 = totalPuntos * 0.4 / maxPuntosG * 10;
    let calf2 = califTec;

    let calificacion = calf1 + calf2;

    calificacion = calificacion.toFixed(2);

    if (calificacion > 10) {
      calificacion = 10;
    } else {
      calificacion = calificacion;
    }
    console.log(totalPuntos);
    console.log("calificacion anecdotario: ", califTec);
    console.log("calificacion generica:", calf1);
    console.log("calificacion anecdotario:", calf2);
    console.log("CALIFICACION FINAL:", calificacion);

    if (isNaN(calificacion)) {
      $("#totalPuntos2").val(0);
      preguntasFaltantes = true;
    } else {
      console.log("CALIFICACION FINAL:", calificacion);
      calificacion = ajusteCalifCapacitacion(calificacion);

      $("#totalPuntos2").val(calificacion);
      var x = document.getElementById("alertCapacitaciones");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    /* VALIDACION PARA GUARDAR CALIFICACION */
    if (preguntasFaltantes == false && !isNaN(calificacion)) {
      $("#totalPuntos2").val(calificacion);
      $("#readysaveEvaluacion").prop("disabled", false);
    }
  } else {
    /* PREGUNTAS TECNICAS */
    for (let i = 0; i < totalPreguntasTec; i++) {
      let idPreguntaTec = $("#idptec" + i).val();
      let valorRTec = $(
        "input:radio[name=preguntaTec" + idPreguntaTec + "]:checked"
      ).val();
      if (isNaN(valorRTec)) {
        Swal.fire({
          icon: "warning",
          confirmButtonColor: "#213c6d",
          showConfirmButton: false,
          title: "DEBES CONTESTAR TODAS LAS PREGUNTAS TECNICAS!",
          text:
            "Una de las Preguntas esta aun sin responder porfavor verificalo!",
          allowOutsideClick: false,
          allowEnterKey: false,
          allowEscapeKey: false,
          timer: 3500
        });
        preguntasFaltantes = true;
      }
      countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
      let objtec = {
        idPreguntaTecr: idPreguntaTec,
        respTec: valorRTec
      };
      arregloTec.push(objtec);
    }

    let totalPuntosTec = countPuntosTec;
    let calf2 = countPuntosTec * 0.4 / maxPuntosTec;
    let calificacion = (calf1 + calf2) * 10;
    if (calificacion > 10) {
      calificacion = 10;
    } else {
      calificacion = calificacion;
    }
    calificacion = calificacion.toFixed(2);

    if (isNaN(calificacion)) {
      $("#totalPuntos2").val(0);
      preguntasFaltantes = true;
    } else {
      console.log("CALIFICACION FINAL:", calificacion);
      calificacion = ajusteCalifCapacitacion(calificacion);
      $("#totalPuntos2").val(calificacion);
      var x = document.getElementById("alertCapacitaciones");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }

    /* VALIDACION PARA GUARDAR CALIFICACION */
    if (preguntasFaltantes == false && !isNaN(calificacion)) {
      $("#totalPuntos2").val(calificacion);
      $("#readysaveEvaluacion").prop("disabled", false);
    }
  }
}

function alertcalificacion() {
  var url = location.origin;
  var path = window.location.pathname;
  Swal.fire({
    icon: "error",
    confirmButtonColor: "#213c6d",
    title: "FALTA LA CALIFICACION DEL ANECDOTARIO!",
    text: "Necesitas evaluar primero en el anecdotario!"
  });
  setTimeout(function() {
    window.location.href = url + path + "?controller=evausuario&action=index";
  }, 2250);
}

function guardarRespuestas() {
  let countPuntos = 0; /* CONTADOR DE PUNTOS  */
  let countPuntosTec = 0;
  let arreglo = []; /* arreglo de respuestas */
  let arregloTec = []; /* arreglo de repuestas Tecnicas */
  let anecdotatio = []; /* arreglo del Anecdotario  */
  let califAnecdotario1;
  let existAnecdotario1;
  let statusresG = false;
  let statusresTec;
  let evalua360 = $("#evalua360").val();
  let totalPreguntas = $("#totalPreguntas").val();
  let totalPreguntasTec = $("#totalPreguntasTec").val();
  let compromisos = $("#compromisos").val();
  var califCap = parseFloat($("#calificaconCapF").val());
  let capacitacion = $("#capacitacion").val();
  let periodo = $("#idperiodo").val();
  let preguntaFaltante = 0;

  /* OBTENEMOS LAS RESPUESTAS DEL CUESTIONARIO GENERAL */
  for (let i = 0; i < totalPreguntas; i++) {
    let idBloque = $("#bloqueNo" + i).val();
    let idPregunta = $(
      "#idp" + i
    ).val(); /* console.log("idPregunta"+idPregunta); */
    let valorR = $(
      "input:radio[name=pregunta" + idPregunta + "]:checked"
    ).val();

    if (isNaN(valorR)) {
      Swal.fire({
        icon: "warning",
        confirmButtonColor: "#213c6d",
        showConfirmButton: false,
        title: "FALTAN PREGUNTAS POR CONTESTAR!",
        text:
          "Una de las preguntas aun esta sin responder porfavor verificalo!",
        allowOutsideClick: false,
        allowEnterKey: false,
        allowEscapeKey: false,
        timer: 3500
      });
      setTimeout(function() {}, 1150);
      statusresG = true;
      preguntaFaltante = idPregunta;
    }
    countPuntos = parseFloat(valorR) + parseFloat(countPuntos);
    let objt = {
      idPreguntra: idPregunta,
      respuesta: valorR,
      idbloque: idBloque
    };
    arreglo.push(objt); /* console.log(valorR); */
  }

  let statusresTec2 = false;
  if ($("#califAnecdotario").length) {
    /* GENERAMOS LA CALIFICACION DEL ANECDOTARIO */
    let califTec = parseFloat($("#califAnecdotario").val());
    let calf2 = califTec;
    calf2 = calf2.toFixed(2);
    let califAnecdotario = calf2;
    let existAnecdotario = 1;

    califAnecdotario1 = califAnecdotario;
    existAnecdotario1 = existAnecdotario;
  } else {
    for (let i = 0; i < totalPreguntasTec; i++) {
      let idPreguntaTec = $("#idptec" + i).val();
      let competenciatec = $("#competenciatec" + i).val();
      let valorRTec = $(
        "input:radio[name=preguntaTec" + idPreguntaTec + "]:checked"
      ).val();

      if (isNaN(valorRTec)) {
        Swal.fire({
          icon: "warning",
          confirmButtonColor: "#213c6d",
          showConfirmButton: false,
          title: "DEBES CONTESTAR TODAS LAS PREGUNTAS TECNICAS!!",
          text:
            "Una de las Preguntas esta aun sin responder porfavor verificalo!",
          allowOutsideClick: false,
          allowEnterKey: false,
          allowEscapeKey: false,
          timer: 3500
        });
        setTimeout(function() {}, 1150);
        statusresTec = true;
        preguntaFaltante = i;
      }
      countPuntosTec = parseFloat(valorRTec) + parseFloat(countPuntosTec);
      let objtec = {
        idPreguntaTecr: idPreguntaTec,
        competenciatec: competenciatec,
        respTec: valorRTec
      };
      arregloTec.push(objtec);
    }
    statusresTec2 = statusresTec;
  }

  /* TOTAL DE PUNTOS */
  let idUsuario = $("#idEmpleado").val();
  let tipoevaluacion = $("#tipoevaluacion").val();
  let autoevalua = $("#autoevalua").val();
  let totalPuntosG = countPuntos;
  let totalPuntosTec = countPuntosTec;

  /* objeto que se envia */
  let objtUser = {
    idusuario: idUsuario,
    evalua360: evalua360,
    tipoevaluacion: tipoevaluacion,
    autoevalua: autoevalua,
    totalPuntosG: totalPuntosG,
    totalPuntosTec: totalPuntosTec,
    respuestas: arreglo,
    respuestasTec: arregloTec,
    califAnecdotario: califAnecdotario1,
    existAnecdotario: existAnecdotario1,
    compromisos: compromisos,
    capacitacion: capacitacion,
    califCapacitacion: califCap,
    periodo: periodo
  };

  if (statusresTec2 == true && statusresG == true) {
    Swal.fire({
      icon: "warning",
      confirmButtonColor: "#213c6d",
      showConfirmButton: false,
      title: "FALTAN PREGUNTAS POR CONTESTAR!",
      text: "Una de las preguntas aun esta sin responder porfavor verificalo!",
      allowOutsideClick: false,
      allowEnterKey: false,
      allowEscapeKey: false,
      timer: 3500
    });
    console.log(statusresTec2);
    console.log("FALTAN PREGUNTAS POR CONTESTAR");
  } else {
    var url = location.origin;
    var path = window.location.pathname;

    console.log(objtUser); /* RESPUESTAS DEL USUARIO  */

    $.post(
      "config/helpers/guardarEvaluacionUsuario.php",
      {
        objtUseR: objtUser
      },
      function(mensaje) {
        Swal.fire({
          icon: "success",
          confirmButtonColor: "#213c6d",
          showConfirmButton: false,
          title: "Evaluacion Guardada!",
          text: "La evaluacion se ha guardado CORRECTAMENTE!",
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
}

function ajusteCalifCapacitacion(califEva) {
  var califEva = parseFloat(califEva);
  var califCap = parseFloat($("#calificaconCapF").val());

  var califEvaPeriodoFinal = califEva - 1;
  califEvaPeriodoFinal = califEvaPeriodoFinal + califCap;

  return califEvaPeriodoFinal;
}
