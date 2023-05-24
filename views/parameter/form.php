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
                        <h4 class="card-title">Formulario de par&aacute;metros de negocio</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo constant("URL") ?>/parameter/guardar" method="POST">
                        <div>
                            <h5 class="card-title">Ingresar datos</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Nombre</label>
                                        <input type="text" class="form-control" id="label" name="label" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "' readonly" : "" ?>>
                                        <p id="message" style="font-size: 0.8em;"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-materno">Tipo de dato</label>
                                        <?php if ($this->data == null) { ?>
                                            <select class="form-select" id="type" name="type" <?php echo $this->data != null ? "readonly" : "" ?>>
                                                <?php foreach (constant("TYPE-DATA") as $key => $value) { ?>
                                                    <option value="<?php echo $key ?>" <?php echo $this->data == null ? "" : ($this->data["TIPO"] == $key ? "selected" : "") ?>><?php echo $value ?></option>
                                                <?php } ?>
                                            </select>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" id="email1" name="type" value="<?php echo constant("TYPE-DATA")[$this->data['TIPO']] ?>" readonly>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Valor</label>
                                        <?php if ($this->data != null) { ?>
                                            <?php if ($this->data["TIPO"] == 'N') { ?>
                                                <input type="number" class="form-control" id="value" name="value" step="0.001" required <?php echo $this->data != null ? "value='" . $this->data['VALOR'] . "'" : "" ?>>
                                            <?php } else { ?>
                                                <input type="text" class="form-control" id="value" name="value" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['VALOR'] . "'" : "" ?>>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" id="value" name="value" maxlength="50" required>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-horizontal">
                        <div>
                            <input type="submit" class="btn btn-primary" value="Guardar" id="save">
                            <a href="<?php echo constant("URL") ?>/parameter" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //Cambio de los atributos de inptu segun tipo
    document.getElementById('type').addEventListener('change', function(e) {
        let value = document.getElementById('value');
        switch (e.target.value) {
            case "S":
                value.type = "text";
                value.maxlength = 50;
                break;

            case "N":
                value.type = "number";
                value.min = 0;
                value.step = 0.001;
                break;

            default:
                break;
        }
        value.value = "";
    });

    $(document).ready(function() {
        $("#label").change(function() {
            var label = $(this).val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/parameter/validParameter",
                type: "POST",
                data: {
                    label: label
                },
                success: function(respuesta) {
                    $("#message").html(respuesta > 0 ? "El parámetro ya se encuentra registrado" : "Parámetro nuevo").css("color", respuesta > 0 ? "#c03221" : "#1aa053");
                    $('#save').prop('disabled', respuesta > 0);
                }
            });
        });
    });
</script>
<?php require 'views/shared/footer.php'; ?>