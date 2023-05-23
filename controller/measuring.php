<?php

class Measuring extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->shared = new SharedModel();
        $this->view->titleWeb = constant("SYS-SHORT") . " - Medición";
        $this->view->title = "Registro de medición";
        $this->view->subtitle = "Este gestor facilitará el registro de las mediciones realizadas.";
        $this->view->condominio = [];
        $this->view->servicio = [];
    }

    public function render()
    {
        $this->view->condominio = $this->shared->getCondominio();
        $this->view->servicio = $this->shared->getServicio();
        $this->view->render('measuring/index');
    }

    public function gethouse()
    {
        $data = $this->model->getHouse($_POST["condominio"], $_POST["servicio"]);
        echo ('<div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th>Titular</th>
                            <th>Documento</th>
                            <th>Manzana</th>
                            <th>Lote</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>');
        foreach ($data as $value) {
            echo ('<tr>
                    <th>' . $value["TITULAR"] . '</th>
                    <th>' . $value["DOCUMENTO"] . '</th>
                    <th>' . $value["MANZANA"] . '</th>
                    <th>' . $value["LOTE"] . '</th>
                    <th>' . ($value["MEDICION"] != null && $_POST["servicio"] == 1 ?
                '<button type="button" id="btn-abrir-modal" class="btn btn-sm btn-icon text-primary flex-end" 
                data-condominio="' . $value["CONDOMINIO"] . '" data-manzana="' . $value["MANZANA"] . '"  data-lote="' . $value["LOTE"] . '" 
                data-medicion="' . $value["MEDICION"] . '"  data-imagen="'  . $value["IMAGEN"] . '"  data-nombres="' . $value["NOMBRES"] . '" 
                data-bs-toggle="tooltip" title="Visualizar medición">
                            <span class="btn-inner">    
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    
                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="#130F26"></path>                                    
                                    <circle cx="12" cy="12" r="5" stroke="#130F26"></circle>                                    
                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    
                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    
                                        <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    
                                    </mask>                                    
                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    
                                </svg>                              
                            </span>                      
                        </button>' :
                '<button type="button" id="btn-abrir-modal" class="btn btn-sm btn-icon text-primary flex-end" 
                data-condominio="' . $value["CONDOMINIO"] . '" data-manzana="' . $value["MANZANA"] . '"  data-lote="' . $value["LOTE"] . '" 
                data-medicion="' . $value["MEDICION"] . '"  data-imagen="'  . $value["IMAGEN"] . '"  data-nombres="' . $value["NOMBRES"] . '" 
                data-id="' . $value["ID"] . '" data-bs-toggle="tooltip" title="Ingresar medida">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>                                            
                        </button>') . '
                    </th>
                    </tr>');
        }
        echo ('      </tbody>
                </table>
            </div>');
    }

    public function guardar()
    {
        date_default_timezone_set('America/Lima');
        $fecha_actual = new DateTime('now');

        $data = array(
            "id" => $_POST["id"],
            "registro" => $fecha_actual->format('Y-m-d'),
            "usuario" => $_SESSION["user"]["USUARIO"],
            "medicion" => $_POST["medicion"]
        );

        try {
            if (isset($_FILES['input-imagen']) && $_FILES['imagen']['error'] == 0 && $_POST["servicio"] == 1) {
                $directorio_destino = getcwd() . '/assets/data/';
                $nombre_temp = explode(".", $_FILES['input-imagen']['name']);
                $archivo_nombre = $fecha_actual->format('Y-m-d') . "_" . $_POST["id"] . "." . array_pop($nombre_temp);
                $archivo_temporal = $_FILES['input-imagen']['tmp_name'];
                $data["imagen"] = $archivo_nombre;

                if (!move_uploaded_file($archivo_temporal, $directorio_destino . $archivo_nombre)) {
                    throw new Exception('Error al guardar la evidencia.');
                }
            }

            $this->model->guardar($data);
        } catch (Exception $ex) {
            echo $ex;
        }

        $this->gethouse();
    }
}
