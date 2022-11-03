<?php
$db = new mysqli("localhost","root","12345678","productos_crud", 3306);
if($db->connect_errno){
    echo "Conexión a la base de datos fallida";
}
?>