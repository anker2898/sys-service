<?php require 'views/shared/header.php'; ?>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Recibo</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo constant("URL") ?>/parameter/guardar" method="POST">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="nombres">Nombre</label>
                                    <input type="text" class="form-control" id="label" name="label" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "' readonly" : "" ?>>
                                    <p id="message" style="font-size: 0.8em;"></p>
                                </div>
                            </div>
                            <div class="col-4">
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
                            <div class="col-4">
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
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label" for="nombres">Nombre</label>
                                    <input type="text" class="form-control" id="label" name="label" maxlength="50" required <?php echo $this->data != null ? "value='" . $this->data['LABEL'] . "' readonly" : "" ?>>
                                    <p id="message" style="font-size: 0.8em;"></p>
                                </div>
                            </div>
                            <div class="col-4">
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
                            <div class="col-4">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/shared/footer.php'; ?>