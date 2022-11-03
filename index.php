<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Importación de librerías -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js" integrity="sha512-Hy060ZqSc7vmSP4ZtCIG9zxhc9/hEjuWtnsv3C1sqPo+JLWa5JOsDe0aZkVyj7vkft9d1D07PDB3RrUOF3jzGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
    require "header.php";
    if ($_REQUEST["view"] == "") {
        echo '<script type="text/javascript">window.location.replace("./altaProductos");</script>';
    }
    if (file_exists("modules/".$_REQUEST["view"].".php")){
        include "modules/".$_REQUEST["view"].".php";
    }else{
        include "modules/altaProductos.php";
    }
    if (file_exists("modules/".$_REQUEST["view"].".js")){
    ?>
        <script type="text/javascript" src="modules/<?=$_REQUEST["view"]?>.js"></script>
    <?php }else{?>
        <script type="text/javascript" src="modules/altaProductos.js"></script>
    <?php } ?>
</body>
</html>