<?php
if (isset($_SESSION['errorLogin']) && $_SESSION['errorLogin'] == true) {?>
    <script>
      var url = location.origin;
      var path = window.location.pathname;
      Swal.fire({ icon: "warning", title: "Error al Iniciar Session!", text: "El Usuario o la Contraseña son Incorrectos!",})
                
      setTimeout(function () {
   window.location.href = url+path; //URL DEL LOGIN
}, 2100); //SI EL USUARIO  NO EXISTE MUESTRA LA ALERTA Y REDIRIQUE A LA URL DE LOGIN 
  </script>
  <?php
  
  }

?>