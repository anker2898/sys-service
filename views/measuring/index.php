<?php require 'views/shared/header.php'; ?>
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-contenido {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .cerrar-modal {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .cerrar-modal:hover,
    .cerrar-modal:focus {
        color: black;
        text-decoration: none;
    }

    #visualizador-imagen {
        max-width: 100%;
        max-height: 300px;
        margin-top: 10px;
    }
</style>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Registros de medici&oacute;n de suministro</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="form-label" for="condominio">Condominio</label>
                                <select class="form-select" id="condominio" name="condominio">
                                    <?php foreach ($this->condominio as $value) { ?>
                                        <option value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="form-label" for="servicio">Servicio</label>
                                <select class="form-select" id="servicio" name="servicio">
                                    <?php foreach ($this->servicio as $key => $value) { ?>
                                        <option value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="form-label" for="apellido-materno">&nbsp;</label><br>
                                <button type="button" class="btn btn-primary" id="buscar">
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="data-house">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mi-modal" class="modal">
    <div class="modal-contenido">
        <div class="row">
            <div class="col-sm-12">
                <h4>Registrar medici&oacute;n</h4>
            </div>
        </div>
        <hr class="hr-horizontal">
        <form id="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="form-label" for="condominio-nombre">Condominio</label>
                        <input type="text" class="form-control" id="condominio-nombre" name="condominio-nombre" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label" for="manzana">Manzana</label>
                        <input type="text" class="form-control" id="manzana" name="manzana" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label" for="lote">Lote</label>
                        <input type="text" class="form-control" id="lote" name="lote" readonly>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="form-label" for="medicion">Medici&oacute;n</label>
                        <input type="number" class="form-control" id="medicion" name="medicion" step="0.0001">
                    </div>
                </div>
                <div class="col-sm-12" id="input-usuario">
                    <div class="form-group">
                        <label class="form-label" for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="form-label" for="evidencia">Evidencia</label>
                        <input class="form-control" type="file" id="input-imagen" name="input-imagen">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div id="visualizador-imagen" class="text-center"></div>
                </div>
                <hr class="hr-horizontal">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="imagen" id="imagen">
                        <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                        <button id="cerrar-modal" type="button" class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#buscar").click(function() {
            $.ajax({
                url: "<?php echo constant("URL") ?>/measuring/getHouse",
                type: "POST",
                data: {
                    condominio: $('#condominio').val(),
                    servicio: $('#servicio').val()
                },
                success: function(respuesta) {
                    $("#data-house").html(respuesta);
                }
            });
        });
    });

    $(document).on('click', '#btn-abrir-modal', function() {
        $('#mi-modal').fadeIn();

        $('#manzana').val($(this).data('manzana'));
        $('#lote').val($(this).data('lote'));
        $('#condominio-nombre').val($(this).data('condominio'));
        $('#imagen').val($(this).data('imagen'));

        if ($(this).data('medicion') == "") {

            $('#input-usuario').hide();
            $('#medicion').prop('required', true);
            $('#medicion').prop('readonly', false);
            $('#input-imagen').prop('required', true);
            $('#id').val($(this).data('id'));
            $('#usuario').hide();
            $('#guardar').show();
            $('#input-imagen').show();

        } else {

            $('#guardar').hide();
            $('#medicion').val($(this).data('medicion'));
            $('#medicion').prop('readonly', true);
            $('#usuario').show();
            $('#input-usuario').show();
            $('#usuario').val($(this).data('nombres'));
            $('#usuario').prop('readonly', true);
            $('#input-imagen').hide();
            let path = '<?php echo constant("URL") ?>/shared/image/' + $(this).data('imagen');
            $('#visualizador-imagen').html('<img src="' + path + '" class="img-fluid">');

        }

    });

    $('body').on('click', '#cerrar-modal', function() {
        $('#mi-modal').fadeOut();
        $('#visualizador-imagen').html("");
        $('#form').trigger('reset');
    });

    $(document).ready(function() {

        $('#input-imagen').change(function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#visualizador-imagen').html('<img src="' + reader.result + '" class="img-fluid">');
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                $('#visualizador-imagen').html("");
            }
        });

        $('#form').submit(function(event) {
            event.preventDefault();

            let data = new FormData(this);
            data.append("condominio", $('#condominio').val());
            data.append("servicio", $('#servicio').val());

            $.ajax({
                url: "<?php echo constant("URL") ?>/measuring/guardar",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(respuesta) {
                    $("#data-house").html(respuesta);
                    $('#mi-modal').fadeOut();
                    $('#visualizador-imagen').html("");
                    $('#form').trigger('reset');
                }
            });
        });

    });
</script>
<?php require 'views/shared/footer.php'; ?>