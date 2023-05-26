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
                    <div class="row">
                        <?php if (count($this->condominio) > 1) { ?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="condominio">Condominio</label>
                                    <select class="form-select" id="condominios" name="condominios">
                                        <?php foreach ($this->condominio as $value) { ?>
                                            <option value="<?php echo $value[0] ?>"><?php echo $value[1] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input type="hidden" id="condominios" name="condominios" value="<?php echo $this->condominio[0][0] ?>">
                        <?php } ?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="suministro">Suministro</label>
                                <input type="text" class="form-control" id="suministro" name="suministro" maxlength="11">
                                <p id="message" style="font-size: 0.8em;"></p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="servicio">Servicio</label>
                                <select class="form-select" id="servicio" name="servicio" disabled>
                                    <option value="0" disabled selected>Seleccionar servicio</option>
                                    <option value="1">Energ&iacute;a el&eacute;ctrica</option>
                                    <option value="2">Agua potable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="recibos">Recibos</label>
                                <select class="form-select" id="recibos" name="recibos" disabled>
                                    <option value="0" disabled selected>Seleccionar recibos</option>
                                    <option value="2">Agua potable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?php if (count($this->condominio) > 1) { ?>
                                    <label class="form-label" for="apellido-materno">&nbsp;</label><br>
                                <?php } ?>
                                <button type="button" class="btn btn-primary" id="buscar" disabled>
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-horizontal">
                    <div class="header-title">
                        <h6 class="card-title">Datos del cliente</h6>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="nombres">Nombre y Apellido:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" readonly>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="form-label" for="condominio">Condominio:</label>
                                <input type="text" class="form-control" id="condominio" name="condominio" readonly>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="form-label" for="manzana">Manzana:</label>
                                <input type="text" class="form-control" id="manzana" name="manzana" readonly>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="form-label" for="lote">Lote:</label>
                                <input type="text" class="form-control" id="lote" name="lote" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="departamento">Departamento:</label>
                                <input type="text" class="form-control" id="departamento" name="departamento" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="nombres">Provincia:</label>
                                <input type="text" class="form-control" id="provincia" name="provincia" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="nombres">Distrito:</label>
                                <input type="text" class="form-control" id="distrito" name="distrito" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="header-title">
                        <h6 class="card-title">Datos del servicio</h6>
                    </div>
                    <div class="row" id="luz">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-6 align-self-center mb-0" for="anterior">Lectura anterior:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="anterior" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-6 align-self-center mb-0" for="actual">Lectura actual:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="actual" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="actual-pricing" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center mb-0" for="email1">Mantenimiento sub-estaci&oacute;n:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="mantenimiento" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center mb-0" for="email1">Alumbrado p&uacute;blico:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="alumbrado" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-horizontal">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center text-end mb-0" for="email1">Sub-total:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="subtotal" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center text-end mb-0" for="email1">Deuda vencida:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="deuda" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center text-end mb-0" for="email1">Total:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="total" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="agua">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-6 align-self-center mb-0" for="consumo">Consumo:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="consumo">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="consumo-pricing">
                                </div>
                            </div>
                        </div>
                        <hr class="hr-horizontal">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center text-end mb-0" for="email1">Sub-total:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="subtotal-agua">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center text-end mb-0" for="email1">Deuda vencida:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="deuda-agua">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-9 align-self-center text-end mb-0" for="email1">Total:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="total-agua">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-horizontal">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="control-label col-sm-1 align-self-center mb-0" for="consumo">Pago:</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="pago" step="0.01" readonly>
                                    <input type="hidden" name="id" id="id">
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-primary" id="pagar">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7689 8.3818H22C22 4.98459 19.9644 3 16.5156 3H7.48444C4.03556 3 2 4.98459 2 8.33847V15.6615C2 19.0154 4.03556 21 7.48444 21H16.5156C19.9644 21 22 19.0154 22 15.6615V15.3495H17.7689C15.8052 15.3495 14.2133 13.7975 14.2133 11.883C14.2133 9.96849 15.8052 8.41647 17.7689 8.41647V8.3818ZM17.7689 9.87241H21.2533C21.6657 9.87241 22 10.1983 22 10.6004V13.131C21.9952 13.5311 21.6637 13.8543 21.2533 13.8589H17.8489C16.8548 13.872 15.9855 13.2084 15.76 12.2643C15.6471 11.6783 15.8056 11.0736 16.1931 10.6122C16.5805 10.1509 17.1573 9.88007 17.7689 9.87241ZM17.92 12.533H18.2489C18.6711 12.533 19.0133 12.1993 19.0133 11.7877C19.0133 11.3761 18.6711 11.0424 18.2489 11.0424H17.92C17.7181 11.0401 17.5236 11.1166 17.38 11.255C17.2364 11.3934 17.1555 11.5821 17.1556 11.779C17.1555 12.1921 17.4964 12.5282 17.92 12.533ZM6.73778 8.3818H12.3822C12.8044 8.3818 13.1467 8.04812 13.1467 7.63649C13.1467 7.22487 12.8044 6.89119 12.3822 6.89119H6.73778C6.31903 6.89116 5.9782 7.2196 5.97333 7.62783C5.97331 8.04087 6.31415 8.37705 6.73778 8.3818Z" fill="currentColor"></path>
                                        </svg>
                                        Pagar
                                    </button>
                                </div>
                                <div id="estado" class="col-sm-3"></div>
                                <div class="col-sm-3" id="div-descargar">
                                    <a href="<?php echo constant("URL") ?>/invoice/descargar" class="btn btn-primary" id="descargar">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.81 2H16.191C19.28 2 21 3.78 21 6.83V17.16C21 20.26 19.28 22 16.191 22H7.81C4.77 22 3 20.26 3 17.16V6.83C3 3.78 4.77 2 7.81 2ZM8.08 6.66V6.65H11.069C11.5 6.65 11.85 7 11.85 7.429C11.85 7.87 11.5 8.22 11.069 8.22H8.08C7.649 8.22 7.3 7.87 7.3 7.44C7.3 7.01 7.649 6.66 8.08 6.66ZM8.08 12.74H15.92C16.35 12.74 16.7 12.39 16.7 11.96C16.7 11.53 16.35 11.179 15.92 11.179H8.08C7.649 11.179 7.3 11.53 7.3 11.96C7.3 12.39 7.649 12.74 8.08 12.74ZM8.08 17.31H15.92C16.319 17.27 16.62 16.929 16.62 16.53C16.62 16.12 16.319 15.78 15.92 15.74H8.08C7.78 15.71 7.49 15.85 7.33 16.11C7.17 16.36 7.17 16.69 7.33 16.95C7.49 17.2 7.78 17.35 8.08 17.31Z" fill="currentColor"></path>
                                        </svg>
                                        Descargar
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $("#agua").hide();
        $("#pagar").hide();
        $("#div-descargar").hide();
        $("#buscar").click(function() {

            if ($("#servicio").val() == 1) {
                $("#luz").show();
                $("#agua").hide();
            } else {
                $("#luz").hide();
                $("#agua").show();
            }
            $.ajax({
                url: "<?php echo constant("URL") ?>/invoice/getRecibo",
                type: "POST",
                data: {
                    recibo: $('#recibos').val(),
                },
                success: function(respuesta) {
                    let datos = JSON.parse(respuesta);
                    let montoActual = parseFloat(datos.monto) - (parseFloat(datos.mantenimiento) + parseFloat(datos.alumbrado));
                    $("#nombres").val(datos.nombres);
                    $("#condominio").val(datos.condominio);
                    $("#manzana").val(datos.manzana);
                    $("#lote").val(datos.lote);
                    $("#departamento").val(datos.departamento);
                    $("#provincia").val(datos.provincia);
                    $("#distrito").val(datos.distrito);
                    $('#div-descargar').show();
                    $("#id").val(datos.id);
                    $('#descargar').prop('href', `<?php echo constant("URL") ?>/invoice/descargar/${datos.id}`);

                    let html = "";
                    switch (datos.estado) {
                        case "1":
                            $("#por-pagar").show();
                            html = '<p class="h3"><span class="badge rounded-pill bg-light text-dark"> Pendiente de pago </span></p>';
                            break;
                        case "2":
                            $("#por-pagar").hide();
                            html = '<p class="h3"><span class="badge bg-danger">Vencido</span></p>';
                            break;
                        case "3":
                            $("#por-pagar").hide();
                            html = '<p class ="h3"><span class="badge bg-success">Cancelado</span></p>';
                            break;
                    }
                    $("#estado").html(html);

                    if (datos.alumbrado) {
                        $("#anterior").val(`${datos.inicial} kw`);
                        $("#actual").val(`${datos.medicion} kw`);
                        $("#actual-pricing").val(montoActual.toFixed(2));
                        $("#mantenimiento").val(datos.mantenimiento);
                        $("#alumbrado").val(datos.alumbrado);
                        $("#subtotal").val(datos.monto);
                        $("#deuda").val(datos.deuda);
                        $("#total").val(datos.total);
                    } else {
                        $("#consumo").val(parseInt(datos.medicion));
                        $("#consumo-pricing").val(datos.monto);
                        $("#subtotal-agua").val(datos.monto);
                        $("#deuda-agua").val(datos.deuda);
                        $("#total-agua").val(datos.total)
                    }

                    if (datos.pago > "0.00") {
                        $("#pago").val(datos.pago);
                        $("#pago").prop("readonly", true);
                        $("#pagar").hide();
                    } else {
                        $("#pago").val("");
                        $("#pago").prop("readonly", false);
                        $("#pagar").show();
                    }
                }
            });
        });

        $("#suministro").keyup(function() {
            if ($(this).val().length == 11) {
                $.ajax({
                    url: "<?php echo constant("URL") ?>/shared/getSuministro",
                    type: "POST",
                    data: {
                        suministro: $(this).val(),
                        condominio: $("#condominios").val()
                    },
                    success: function(respuesta) {
                        let response = JSON.parse(respuesta);
                        $("#message").html(response["valido"] ? "" : "No se encontraron recibos.")
                            .css("color", response["valido"] ? "" : "#c03221");
                        $("#servicio").prop("disabled", !response["valido"]);
                        $("#recibos").prop("disabled", !response["valido"]);
                    }
                });
            } else {
                if (!$("#servicio").prop("disabled")) {
                    $("#servicio").val('0');
                    $("#servicio").prop("disabled", true);
                }
                if (!$("#recibos").prop("disabled")) {
                    $("#recibos").val('0');
                    $("#recibos").prop("disabled", true);
                }
                $("#buscar").prop("disabled", true);
            }
        });

        $("#servicio").change(function() {
            $("#buscar").prop("disabled", true);
            $.ajax({
                url: "<?php echo constant("URL") ?>/shared/getRecibosAll",
                type: "POST",
                data: {
                    suministro: $("#suministro").val(),
                    servicio: $(this).val(),
                },
                success: function(respuesta) {
                    let response = JSON.parse(respuesta);
                    const meses = ["Enero", "Febrero", "Marzo", "Abril",
                        "Mayo", "Junio", "Julio", "Agosto",
                        "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ];
                    let html = '<option value="0" disabled selected>Seleccionar recibos</option>';
                    response.forEach(element => {
                        let mes = element.emision.toString().slice(5, 7);
                        html += `<option value="${element.id}">${meses[parseInt(mes)]} - ${element.emision}</option>`;
                    });
                    $("#recibos").html(html);
                }
            });
        });

        $("#recibos").change(function() {
            $("#buscar").prop("disabled", !($(this).val() != 0));
        })

        $("#pagar").click(function() {
            let pago = $('#pago').val() == "" ? "0.00" : $('#pago').val();
            $.ajax({
                url: "<?php echo constant("URL") ?>/invoice/pagar",
                type: "POST",
                data: {
                    recibo: $('#id').val(),
                    pago: pago
                },
                success: function(respuesta) {
                    let result = JSON.parse(respuesta);
                    if (result.success) {
                        $("#por-pagar").hide();
                        $("#estado").html('<p class ="h3"><span class="badge bg-success">Cancelado</span></p>');
                        $("#pago").prop("readonly", true);
                        $("#pagar").hide();
                    } else {
                        console.error(result.message);
                    }

                }
            });
        });
    });
</script>
<?php require 'views/shared/footer.php'; ?>