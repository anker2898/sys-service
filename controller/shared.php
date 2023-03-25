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
}
