<?php

class Shared extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function provincia()
    {
        $provincias = $this->model->getProvincia($_POST["departamento"]);
        echo "<option value='' disabled selected>Seleccionar Provincia</option>";
        foreach ($provincias as $value) {
            echo "<option value='" . $value[0] . "'>" . $value[1] . "</option>";
        }
    }

    public function distrito()
    {
        $provincias = $this->model->getDistrito($_POST["provincia"]);
        echo "<option value='' disabled selected>Seleccionar Distrito</option>";
        foreach ($provincias as $value) {
            echo "<option value='" . $value[0] . "'>" . $value[1] . "</option>";
        }
    }

    public function condominios()
    {
        $condominios = $this->model->getCondominio($_SESSION["user"]["NIDUSER"]);
        echo "<option value='' disabled selected>Seleccionar condominio</option>";
        foreach ($condominios as $value) {
            echo "<option value='" . $value[0] . "'>" . $value[1] . "</option>";
        }
    }

    public function servicio()
    {
        $servicios = $this->model->getServicio();
        foreach ($servicios as $value) {
            echo '<div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="' . $value[0] . '">
            <label class="form-check-label" for="flexCheckDefault11">' . $value[1] . "
            </label>
            </div>";
        }
    }

    public function image($img, $ext = "*")
    {
        $directorio_destino = getcwd() . '/assets/data/';
        $ruta_imagen = $directorio_destino . $img;
        header('Content-Type: image/' . $ext);
        readfile($ruta_imagen);
    }

    public function getSuministro()
    {
        $servicios = $this->model->getSuministro($_POST["suministro"]);
        echo json_encode($servicios);
    }

    public function getRecibosAll()
    {
        $servicios = $this->model->getRecibo($_POST["suministro"], $_POST["servicio"]);
        echo json_encode($servicios);
    }
}
