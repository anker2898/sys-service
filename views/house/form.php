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
                        <h4 class="card-title">Formulario de registro de casas</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo constant("URL") ?>/house/guardar" method="POST" id="formId">
                        <div>
                            <h5 class="card-title">Ingresar datos del cliente</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Documento del titular</label>
                                        <input type="text" class="form-control" id="documento" name="documento" minlength="8" maxlength="8" required <?php echo ($this->data == null ? "" : "value ='" . $this->data["DOCUMENTO"] . "'") ?>>
                                        <p id="message" style="font-size: 0.8em;"></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Nombre del titular </label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" maxlength="50" readonly <?php echo ($this->data == null ? "disabled" : "value ='" . $this->data["NOMBRES"] . "'") ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Correo</label>
                                        <input type="text" class="form-control" id="correo" name="correo" maxlength="50" <?php echo ($this->data == null ? "disabled" : "value ='" . $this->data["CORREO"] . "'") ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Tel&eacute;fono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" minlength="9" maxlength="9" <?php echo ($this->data == null ? "disabled" : "value ='" . $this->data["NUMERO"] . "'") ?>>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">Ingresar datos de la casa</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Condominio</label>
                                        <select class="form-select" id="condominio" name="condominio" <?php echo $this->data != null ? "readonly" : "required disabled" ?>>
                                            <option value='' disabled selected>Seleccionar condominio</option>
                                            <?php foreach ($this->condominio as $key => $value) { ?>
                                                <option value="<?php echo $value[0] ?>" <?php echo $this->data == null ? "" : ($this->data["CONDOMINIO"] == $value[0] ? "selected" : "") ?>><?php echo $value[1] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Manzana</label>
                                        <input type="text" class="form-control" id="manzana" name="manzana" maxlength="2" required <?php echo $this->data != null ? "value='" . $this->data['MANZANA'] . "' readonly" : "disabled" ?>>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Lote</label>
                                        <input type="number" class="form-control" id="lote" name="lote" required <?php echo $this->data != null ? "value='" . $this->data['LOTE'] . "' readonly" : "disabled" ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexCheckDefault11">Energía El&eacute;ctrica
                                                </label>
                                                <input class="form-check-input" type="checkbox" id="luz" value="1" name="luz" disabled>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nombres">Fecha de inicio</label>
                                                        <input type="date" class="form-control" id="inicio-luz" name="inicio-luz" required <?php echo $this->data != null ? "value='" . $this->data['MANZANA'] . "' readonly" : "disabled" ?>>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nombres">Medici&oacute;n inicial</label>
                                                        <input type="number" class="form-control" id="medicion" name="medicion" required <?php echo $this->data != null ? "value='" . $this->data['LOTE'] . "' readonly" : "disabled" ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexCheckDefault11">Agua potable
                                                </label>
                                                <input class="form-check-input" type="checkbox" id="agua" value="1" name="agua" disabled>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="nombres">Fecha de inicio</label>
                                                        <input type="date" class="form-control" id="inicio-agua" name="inicio-agua" required <?php echo $this->data != null ? "value='" . $this->data['MANZANA'] . "' readonly" : "disabled" ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-horizontal">
                        <div>
                            <input type="submit" class="btn btn-primary" value="Guardar" id="save">
                            <a href="<?php echo constant("URL") ?>/house" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#documento").keyup(function() {
            var label = $(this).val();
            if (label.length == 8) {
                $.ajax({
                    url: "<?php echo constant("URL") ?>/house/getClient",
                    type: "POST",
                    data: {
                        documento: label
                    },
                    success: function(respuesta) {
                        let response = JSON.parse(respuesta ?? "{document: null}");
                        $("#message").html(response.DOCUMENTO != null ? "El cliente se encuentra registrado." : "Cliente no resgistrado. Regístrelo <a href='<?php echo constant("URL") ?>/client/new'>aquí</a>").css("color", response.DOCUMENTO != null ? "#1aa053" : "#c03221");
                        $("#nombres").val(response.DOCUMENTO != null ? response.NOMBRE + " " + response.PATERNO + " " + response.MATERNO : "");
                        $("#correo").val(response.DOCUMENTO != null ? response.CORREO : "");
                        $("#telefono").val(response.DOCUMENTO != null ? response.TELEFONO : "");

                        $("#nombres").prop("disabled", response.DOCUMENTO == null);
                        $("#correo").prop("disabled", response.DOCUMENTO == null);
                        $("#telefono").prop("disabled", response.DOCUMENTO == null);
                        $("#condominio").prop("disabled", response.DOCUMENTO == null);
                        $("#manzana").prop("disabled", response.DOCUMENTO == null);
                        $("#lote").prop("disabled", response.DOCUMENTO == null);
                        $("#save").prop("disabled", response.DOCUMENTO == null);
                        $('#luz').prop('disabled', response.DOCUMENTO == null);
                        $('#agua').prop('disabled', response.DOCUMENTO == null);
                    }
                });
            }
        });
        $("#luz").change(function() {
            $('#inicio-luz').prop('disabled', !$(this).prop('checked'));
            $('#medicion').prop('disabled', !$(this).prop('checked'));
        });
        $("#agua").change(function() {
            $('#inicio-agua').prop('disabled', !$(this).prop('checked'));
        });
        $("#suministro").keyup(function() {
            if ($(this).val().length == 11) {
                $.ajax({
                    url: "<?php echo constant("URL") ?>/shared/getSuministro",
                    type: "POST",
                    data: {
                        suministro: $(this).val(),
                    },
                    success: function(respuesta) {
                        let response = JSON.parse(respuesta);
                        $("#message-suministro").html(response["valido"] ? "El suministro se encuentra registrado." : "Suministro nuevo").css("color", response["valido"] ? "#c03221" : "#1aa053");
                        $("#save").prop("disabled", response["valido"]);
                    }
                });
            }
        });
    });
</script>
<?php require 'views/shared/footer.php'; ?>