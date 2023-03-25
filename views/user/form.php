<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require 'views/shared/header.php';
?>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Formulario de usuarios</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo constant("URL") ?>/user/guardar" method="POST">
                        <div class="container">
                            <h5 class="card-title">Datos personales</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Nombres</label>
                                        <input type="text" class="form-control" id="email1" name="nombre" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['NOMBRE'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="email1" name="apPaterno" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['APELLIDO_PAT'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-materno">Apellido Materno</label>
                                        <input type="text" class="form-control" id="email1" name="apMaterno" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['APELLIDO_MAT'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Documento</label>
                                        <input type="text" class="form-control" id="document" name="documento" minlength="8" maxlength="8" required <?php echo $this->data != null ? "value='" . $this->data['DOCUMENTO'] . "' readonly" : "" ?>>
                                        <p id="messageDocument" style="font-size: 0.8em;"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Correo</label>
                                        <input type="email" class="form-control" id="email1" name="correo" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['EMAIL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">N&uacute;mero telef&oacute;nico</label>
                                        <input type="text" class="form-control" id="email1" name="numero" minlength="9" maxlength="9" required <?php echo $this->data != null ? "value='" . $this->data['NUMERO'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Direcci&oacute;n</label>
                                        <input type="text" class="form-control" id="email1" name="direccion" maxlength="200" required <?php echo $this->data != null ? "value='" . $this->data['DIRECCION'] . "'" : "" ?>>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-horizontal">
                            <h5 class="card-title">Credenciales y privilegios</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Usuario</label>
                                        <input type="text" class="form-control" id="user" name="usuario" maxlength="20" required <?php echo $this->data != null ? "value='" . $this->data['USER'] . "' readonly" : "" ?>>
                                        <p id="messageUser" style="font-size: 0.8em;"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group mb-3 ">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="1" name="activo" <?php echo $this->data != null ? $this->data['STATUS'] == 1 ? "checked" : "" : "" ?>>
                                            <label class="form-check-label" for="flexCheckDefault11">
                                                Habilitado
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="reset" value="1" <?php echo $this->data != null ? $this->data['RESET'] == 1 ? "checked" : "" : "checked disabled" ?>>
                                            <label class="form-check-label" for="flexCheckDefault11">
                                                Restablecer contrase&ntilde;a
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-horizontal">
                            <h5 class="card-title">Roles</h5>
                            <div class="row">
                                <?php foreach ($this->roles as $rol) { ?>
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="true" name="<?php echo ($rol[1]) ?>" <?php echo $this->dataRoles[$rol[1]] == 1 ? "checked" : "" ?>>
                                                <label class="form-check-label" for="flexCheckDefault11">
                                                    <?php echo ($rol[1]) ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="container">
                            <input type="submit" class="btn btn-primary" value="Guardar" id="save">
                            <a href="<?php echo constant("URL") ?>/user" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Validacion USUARIO
    $(document).ready(function() {
        $("#user").change(function() {
            var user = $(this).val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/user/validUser",
                type: "POST",
                data: {
                    user: user
                },
                success: function(respuesta) {
                    $("#messageUser").html(respuesta > 0 ? "El usuario ya se encuentra registrado" : "Usuario valido").css("color", respuesta > 0 ? "#c03221" : "#1aa053");
                    $('#save').prop('disabled', respuesta > 0);
                }
            });
        });
    });

    // Validacion DOCUMENTO
    $(document).ready(function() {
        $("#document").change(function() {
            var document = $(this).val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/user/validDocument",
                type: "POST",
                data: {
                    document: document
                },
                success: function(respuesta) {
                    $("#messageDocument").html(respuesta > 0 ? "El documento ya se encuentra registrado" : "Documento nuevo").css("color", respuesta > 0 ? "#c03221" : "#1aa053");
                    $('#save').prop('disabled', respuesta > 0);
                }
            });
        });
    });
</script>
<?php require 'views/shared/footer.php'; ?>