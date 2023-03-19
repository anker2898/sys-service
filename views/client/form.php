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
                                        <input type="text" class="form-control" id="email1" name="nombre" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="email1" name="apPaterno" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Apellido Materno</label>
                                        <input type="text" class="form-control" id="email1" name="apMaterno" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Documento</label>
                                        <input type="text" class="form-control" id="email1" name="documento" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Correo</label>
                                        <input type="text" class="form-control" id="email1" name="correo" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nombres">Tel&eacute;fono</label>
                                        <input type="text" class="form-control" id="email1" name="fono" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "'" : "" ?>>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="apellido-paterno">Direcci&oacute;n</label>
                                        <input type="text" class="form-control" id="value" name="direccion" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['VALOR'] . "'" : "" ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                            <a href="<?php echo constant("URL") ?>/client" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
<?php require 'views/shared/footer.php'; ?>