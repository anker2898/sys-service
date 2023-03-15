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
                        <div class="container">
                            <h5 class="card-title">Ingresar datos</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Nombre</label>
                                        <input type="text" class="form-control" id="email1" name="label" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-materno">Tipo de dato</label>
                                        <select class="form-select" id="type" name="type">
                                            <?php foreach (constant("TYPE-DATA") as $key => $value) {?>
                                                <option value="<?php echo $key?>" <?php echo $this->data == null ? "" : ($this->data["TIPO"] == $key? "selected": "") ?>><?php echo $value?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Valor</label>
                                        <input type="text" class="form-control" id="value" name="value" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['VALOR'] . "'" : "" ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                            <a href="<?php echo constant("URL") ?>/parameter" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('type').addEventListener('change', function(e) {
        let type = document.getElementById('type').value;
        let value = document.getElementById('value');
        switch (type) {
            case "S":
                value.type="text";
                value.maxlength=50;
                break;
        
            case "N":
                value.type="number";
                value.min=0;
                break;
                
            default:
                break;
        }
        value.value = "";
    });
</script>
<?php require 'views/shared/footer.php'; ?>