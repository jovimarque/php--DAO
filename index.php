<?php
require_once("config.php");
require_once("class/sql.php");
$sql = new Sql();

$usuarios = $sql->select(" SELECT * FROM tb_usuario ");

echo json_encode($usuarios);

?>