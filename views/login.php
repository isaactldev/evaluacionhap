<div class="login-box">
  <div class="login-logo">
    <a><b>EVALUACIÓN DEL </b>PERSONAL</a>

  </div>
  <!-- /.login-logo -->
  <div class="card text-center">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
      </p>
      <form action="<?= baseUrl ?>?controller=evaluacion&action=login" method="POST">
        <div class="login-logo">
          <img src="<?= baseUrl ?>assets/img/HAPR.png" class="w-75 p-3" alt="">
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-fw fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </div>
        <!-- /.col -->
    </div>
    </form>
  </div>
</div>
<!-- /.login-box -->