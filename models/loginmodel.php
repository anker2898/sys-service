<?php

class LoginModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function authentication(string $user, string $pass)
    {
        $sql = "CALL SP_AUTH(:P_SUSER, :P_SPASSWORD)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SUSER', $user, PDO::PARAM_STR);
        $stm->bindValue(':P_SPASSWORD', $pass, PDO::PARAM_STR);
        $stm->execute();
        $resultDb = $stm->fetchAll();
        $result = array();
        if (count($resultDb) >= 1) {
            //Obtener Datos del usuario
            $firstRow = $resultDb[0];
            $result["LOGIN"] = true;
            $result["NIDUSER"] = $firstRow["ID"];
            $result["USUARIO"] = $firstRow["USUARIO"];
            $result["ESTADO"] = $firstRow["ESTADO"];
            $result["NOMBRES"] = sprintf("%s %s", $firstRow["NOMBRE"], $firstRow["APELLIDO_PAT"]);
            $result["PRIVILEGIOS"] = array();
            $result["RESET"] = $firstRow["RESET"] == 1;

            //Listar privilegios
            $sql = "CALL SP_AUTH_ROLES(:P_SUSER, :P_SPASSWORD)";
            $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $stm->bindValue(':P_SUSER', $user, PDO::PARAM_STR);
            $stm->bindValue(':P_SPASSWORD', $pass, PDO::PARAM_STR);
            $stm->execute();
            $rolesDB = $stm->fetchAll();
            foreach ($rolesDB as $row) {
                $path = array(
                    "path" => $row["URL"],
                    "label" => $row["LABEL"],
                    "icon" => $row["ICON"],
                );
                array_push($result["PRIVILEGIOS"], $path);
            }

            $_SESSION['login'] = true;
            $_SESSION['user'] = $result;
        }
        return $result;
    }

    public function resetPassword(string $user, string $pass)
    {
        $sql = "CALL SP_RESET_PASSWORD(:P_SUSER, :P_SPASSWORD)";
        $stm = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stm->bindValue(':P_SUSER', $user, PDO::PARAM_STR);
        $stm->bindValue(':P_SPASSWORD', $pass, PDO::PARAM_STR);;
        $stm->execute();
    }
}
