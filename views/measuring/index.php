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
                        <div id="medidor-agua">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg id="decrement" class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75024C6.892 2.75024 2.75 6.89124 2.75 12.0002C2.75 17.1082 6.892 21.2502 12 21.2502C17.108 21.2502 21.25 17.1082 21.25 12.0002C21.25 6.89124 17.108 2.75024 12 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M13.4424 8.52905L9.95638 12.0001L13.4424 15.4711" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span class="fw-bold fs-4 mx-2" id="counter">0</span>
                                <svg id="increment" class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.2498C17.108 21.2498 21.25 17.1088 21.25 11.9998C21.25 6.89176 17.108 2.74976 12 2.74976C6.892 2.74976 2.75 6.89176 2.75 11.9998C2.75 17.1088 6.892 21.2498 12 21.2498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10.5576 15.4709L14.0436 11.9999L10.5576 8.52895" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="input-usuario">
                    <div class="form-group">
                        <label class="form-label" for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                </div>
                <div id="evidencia" class="col-sm-12">
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
    let min = 0;
    let count = 0;

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
        // ABRIR EL MODAL
        $('#mi-modal').fadeIn();
        $('#form').trigger('reset');
        let servicio = $('#servicio').val();

        // DATOA GENERALES
        $('#manzana').val($(this).data('manzana'));
        $('#lote').val($(this).data('lote'));
        $('#condominio-nombre').val($(this).data('condominio'));

        if (servicio == 1) {
            $('#medicion').show();
            $('#medidor-agua').hide();
            $('#evidencia').show();
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
        } else {

            $('#medidor-agua').show();
            $('#medicion').hide();
            $('#medicion').prop('required', false);
            $('#input-imagen').prop('required', false);
            $('#evidencia').hide();
            $('#input-usuario').hide();
            $('#id').val($(this).data('id'));
            $('#guardar').show();
            $('#input-imagen').show();

            let counterEl = $('#counter');
            counterEl.text($(this).data('medicion') || 0);
            min = counterEl.text();
            count = counterEl.text();



        }

        $(this).removeData();
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
            if ($('#servicio').val() == 2)
                data.append("medicion", $('#counter').text());

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

        $('#decrement').on('click', function() {
            if (count > min) {
                count--;
                $('#counter').text(count);
            }
        });

        $('#increment').on('click', function() {
            count++;
            $('#counter').text(count);
        });
    });
</script>
<?php require 'views/shared/footer.php'; ?>