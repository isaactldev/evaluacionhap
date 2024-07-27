<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?= baseUrl ?>?controller=evaluacion&action=guiaEvaluacion" class="nav-link">Guia del Evaluador</a>
    </li>
    <?php if (isset($_SESSION['identity']->usuario) && $_SESSION['identity']->rol == 'admin') : ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= baseUrl ?>?controller=evaluacion&action=allUsuarioStatusEvaluacion" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block form-switch pt-2">
        <?php $statuPlataforma =  Utils::getStatusPlataforma();
        $checked = ($statuPlataforma->sitioactivo == 1) ? 'checked'  : '';
        $valuecheked = ($statuPlataforma->sitioactivo == 1) ? 2  : 1;
        $statustext = ($statuPlataforma->sitioactivo == 1) ? 'Activa'  : 'Inactiva';
        ?>
        <input class="form-check-input" type="checkbox" role="switch" value="<?= $valuecheked ?>" id="idstatusPlataforma" <?= $checked ?> onchange="plataformaActiv();">
        <label class="form-check-label" for="flexSwitchCheckChecked">Plataforma <?= $statustext ?></label>
      </li>
    <?php endif; ?>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-calendar-check"></i>
        <?php $periodo =  Utils::getPeriodoActivo(); ?>
        <span class=""><strong> PERIODO <?= $periodo->idperiodo ?> ACTIVO </strong> </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="dropdown" href="#">
        | <i class="far fa-user"></i>
        <span class=""><strong> <?= $_SESSION['identity']->usuario ?></strong></span>
      </a>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" href="<?= baseUrl ?>?controller=evaluacion&action=logout">
        <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="19px" viewBox="0 0 512 512">
            <path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z" />
          </svg></span> Cerrar Sesión
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- alta modal -->
<div class="modal" id="acttivarPlataforma">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Activar Plataforma</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?= baseUrl ?>?controller=sitioweb&action=statusPlataforma" method="POST">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Selecciona una opcion</label>
            <?php $periodos = Utils::getPeridos(); ?>
            <select class="form-select" name="statusPlataforma" aria-label="Default select example">
              <option selected>Selecciona el estatus</option>
              <option value="1">Activar Plataforma</option>
              <option value="2">Desactivar Plataforma</option>
            </select>
          </div>
          <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-calendar-check"></i> Actualizar</button>
        </form>
      </div>
      <!-- Modal body -->
    </div>
  </div>
</div>
<script>
  function plataformaActiv() {

    var statusPlataforma = $('#idstatusPlataforma').val();
    var url = location.origin;
    var path = window.location.pathname;

    console.log(statusPlataforma);

    if (statusPlataforma == 1) {
      var textoMensaje = 'Habilitada';
    } else {
      var textoMensaje = 'Inhabilidad';
    }

    $.post("config/helpers/actualizastatusPlataforma.php", {
        statusPlataforma: statusPlataforma
      },
      function(mensaje) {
        Swal.fire({
          icon: 'success',
          showConfirmButton: false,
          title: 'Plataforma ' + textoMensaje + '!',
          text: 'La Plataforma esta ' + textoMensaje + ' para los colaboradores!',
        })
        setTimeout(function() {
          window.location.href = url + path + "?controller=evaluacion&action=allUsuarioStatusEvaluacion";
        }, 2250);
      });
  }
</script>