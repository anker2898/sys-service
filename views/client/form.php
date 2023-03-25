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
                        <h4 class="card-title">Formulario de cliente</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo constant("URL") ?>/client/guardar" method="POST">
                        <div class="container">
                            <h5 class="card-title">Ingresar datos</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Nombre</label>
                                        <input type="text" class="form-control" id="email1" name="nombre" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['NOMBRE'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="email1" name="apPaterno" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['APELLIDO_PAT'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Apellido Materno</label>
                                        <input type="text" class="form-control" id="email1" name="apMaterno" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['APELLIDO_MAT'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Documento</label>
                                        <input type="text" class="form-control" id="document" name="documento" minlength="8" maxlength="8" required <?php echo $this->data != null ? "value='" . $this->data['DOCUMENTO'] . "'" : "" ?>>
                                        <p id="messageDocument"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Correo</label>
                                        <input type="email" class="form-control" id="email1" name="correo" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['EMAIL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Tel&eacute;fono</label>
                                        <input type="tel" class="form-control" id="email1" name="fono" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['NUMERO'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Departamento</label>
                                        <select class="form-select" id="departamento" name="departamento" <?php echo $this->data != null ? "readonly" : "required" ?>>
                                            <option value='' disabled selected>Seleccionar departamento</option>
                                            <?php foreach ($this->departamento as $key => $value) { ?>
                                                <option value="<?php echo $value[0] ?>" <?php echo $this->data == null ? "" : ($this->data["DEPARTAMENTO"] == $value[0] ? "selected" : "") ?>><?php echo $value[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Procincia</label>
                                        <select class="form-select" id="provincia" name="provincia" <?php echo $this->data != null ? "readonly" : "required" ?>>
                                            <option value='' disabled selected>Seleccionar provincia</option>
                                            <?php foreach ($this->provincia as $key => $value) { ?>
                                                <option value="<?php echo $value[0] ?>" <?php echo $this->data == null ? "" : ($this->data["PROVINCIA"] == $value[0] ? "selected" : "") ?>><?php echo $value[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Distrito</label>
                                        <select class="form-select" id="distrito" name="distrito" <?php echo $this->data != null ? "readonly" : "required" ?>>
                                            <option value='' disabled selected>Seleccionar distrito</option>
                                            <?php foreach ($this->distrito as $key => $value) { ?>
                                                <option value="<?php echo $value[0] ?>" <?php echo $this->data == null ? "" : ($this->data["DISTRITO"] == $value[0] ? "selected" : "") ?>><?php echo $value[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Direcci&oacute;n</label>
                                        <input type="text" class="form-control" id="value" name="direccion" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['DIRECCION'] . "'" : "" ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <input type="submit" class="btn btn-primary" value="Guardar" id="save">
                            <a href="<?php echo constant("URL") ?>/client" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Refrescar datos de la provincia
    $(document).ready(function() {
        $("#departamento").change(function() {
            var departamento = $(this).val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/shared/provincia",
                type: "POST",
                data: {
                    departamento: departamento
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    $("#provincia").html(respuesta);
                }
            });
        });
    });

    // Refrescar datos del distrito
    $(document).ready(function() {
        $("#provincia").change(function() {
            var provincia = $(this).val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/shared/distrito",
                type: "POST",
                data: {
                    provincia: provincia
                },
                success: function(respuesta) {
                    console.log(respuesta);
                    $("#distrito").html(respuesta);
                }
            });
        });
    });

    // Validacion DOCUMENTO
    $(document).ready(function() {
        $("#document").change(function() {
            var document = $(this).val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/client/validDocument",
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