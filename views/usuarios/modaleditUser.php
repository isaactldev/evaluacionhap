<!-- Edicion modal -->
<div class="modal" id="edittipoevaluacion<?=$usuario->idusuario?>">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edicion de Usuario </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form action="<?= baseUrl ?>?controller=usuario&action=edit" method="POST">
              <div class="row">
                <div class="col-4 mb-3">
                  <input type="hidden" class="form-control" id="editid" name="id" placeholder="No.Empleado">
                  <label for="formGroupExampleInput" class="form-label">No° Empleado</label>
                  <input type="text" class="form-control" id="noEmpleado" name="noEmpleado" value="<?=$usuario->noempleado?>" placeholder="No.Empleado">
                </div>
                <div class="col-8 mb-3">
                  <fieldset disabled>
                    <label for="formGroupExampleInput" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="<?=$usuario->nombreuser . ' ' . $usuario->appaterno . ' ' . $usuario->apmaterno?>" id="disabledTextInput" >
                  </fieldset>
                  <input type="hidden" class="form-control" id="apPaterno" value="<?=$usuario->apmaterno?> name="apaPaterno">
                </div>
              </div>
              <!-- SELECT DEPARTAMENTO -->
              <div class="row">
              <div class="col-6 mb-3">
              <label for="formGroupExampleInput" class="form-label">Departamento</label>
                <?php $departamentos = Utils::showDepartamento();?>
                  <select id="editdep" class="form-select" name="editdapa" aria-label="Default select example" onchange="cargaPuesto();" >
                    <!-- <option selected>Selecciona el Departamento</option> -->
                    <?php while ($departamento = $departamentos->fetch_object()) : ?>
                    <?=$puestodep = $departamento->iddepartamento?>
                    <?=$selected = isset($usuario) && $departamento->iddepartamento == $usuario->iddepartamento ? 'selected' : ''?>
                    <option value="<?= $departamento->iddepartamento ?>" <?=$selected?>><?= $departamento->depnombre ?></option>
                    <script language="javascript" type="text/javascript">
                        function cargaPuesto(){
                          
                          var idDep = parseInt($("#editdep").val());
                          var idDep2 = parseInt($("#editdep").val());
                          console.log('departamento' , idDep);
                          $.post("config/helpers/cargarPuesto.php", {ID: idDep}, function(mensaje) { $("#editpuesto").html(mensaje); });
                          $.post("config/helpers/cargarEvaluadorxdep.php", {ID: idDep2}, function(mensaje2) { $("#editEvluador").html(mensaje2); });
                          };
                    </script>
                    <?php endwhile; ?>
                  </select>
              </div>
              
              <!-- /SELECT DEPARTAMENTO -->
              <!-- SELECT PUESTO -->
              <div class="col-6 mb-3">
              <label for="formGroupExampleInput" class="form-label">Puesto</label>
                  <select class="form-select" id="editpuesto" name="puesto" aria-label="Default select example">
                    <option selected>Selecciona el Puesto</option>
                  </select>
              </div>
              </div>
              <!-- /SELECT PUESTO -->
              <div class="row">
              <!-- SELECT JERARQUICO -->
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">P. Jerarquico</label>
                  <?php $jerarquias = Utils::showJerarquia(); ?>
                  <select class="form-select" id="jerarquico" name="jerarquico" aria-label="Default select example">
                    <option selected>Selecciona el Departamento</option>
                    <?php while ($jerarquia = $jerarquias->fetch_object()) : ?>
                    <?=$selectedjer = isset($usuario) && $jerarquia->idjerarquia == $usuario->idjerarquia ? 'selected' : ''?>
                    <option value="<?= $jerarquia->idjerarquia ?>" <?=$selectedjer?>><?= $jerarquia->nombre ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluador</label>
                  <select class="form-select" id="editEvluador" name="evaluador" aria-label="Default select example">
                    <option selected>Selecciona el Departamento</option>
                  </select>
                </div>
                <!-- SELECT JERARQUICO -->
                <div class="col-4 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Tipo Evaluación</label>
                  <select class="form-select" name="tipoEva" aria-label="Default select example">
                    <option selected>Selecciona el Tipo de Evaluación</option>
                    <option value="OPERATIVO">OPERATIVO</option>
                    <option value="DIRECTIVO">DIRECTIVO</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-3 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Eva. Personal</label>
                  <select class="form-select" name="persEva" aria-label="Default select example">
                    <option selected>Selecciona el Tipo de Evaluación</option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                  </select>
                </div>
                <div class="col-5 mb-3">
                  <label for="formGroupExampleInput" class="form-label">Evaluacion 360°</label>
                  <select class="form-select" name="eva360" aria-label="Default select example">
                    <option selected>Evaluacion 360°</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="formGroupExampleInput" class="form-label">Estatus</label>
                    <?php $estado = Utils::showEstatus(); ?>
                  <select class="form-select" name="idestatus" aria-label="Default select example">
                    <option selected>Selecciona el estatus</option>
                    <?php while ($status = $estado->fetch_object()) : ?>
                    <option value="<?= $status->idstatus ?>"><?= $status->status ?></option>
                    <?php endwhile; ?>
                  </select>
                  </div>
              </div>
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4"><i class="fas fa-plus-square"></i> Editar Usuario</button>
              </form>
            </div>
            <!-- Modal body -->
          </div>
        </div>
      </div>