<?php
$entidad = "public/productos";

$router->map('GET', "$entidad/prueba/", function(){
    global $db;
    $response["response"] = "success";
    $query = "SELECT * FROM DEPARTAMENTOS";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all();
    print_r(json_encode($response));
}, $entidad."_prueba_");

// =========== VERIFICAR SI EL SKU EXISTE ============
$router->map('GET', "$entidad/verify_sku_existente/", function(){
    global $db;
    $sku = (int) $_REQUEST["sku"];
    $response["response"] = "success";
    $query = "CALL verifySkuExistente(".$sku.")";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all();
    print_r(json_encode(($response)));
}, $entidad."_verify_sku_existente_");

// ================ OBTENER DEPARTAMENTOS =================
$router->map('GET', "$entidad/obtener_departamentos/", function(){
    global $db;
    $response["response"] = "success";
    $query = "CALL obtenerDptos()";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all(MYSQLI_ASSOC);
    print_r(json_encode($response));
}, $entidad."_obtener_departamentos_");

// ================= OBTENER CLASES BY DPTO ================
$router->map('GET', "$entidad/obtener_clases/by_departamento/", function(){
    global $db;
    $dpto = (int) $_REQUEST["dpto"];
    $query = "CALL obtenerClasesPorDept(".$dpto.");";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all(MYSQLI_ASSOC);
    $response["response"] = "success";
    print_r(json_encode($response));
}, $entidad."_obtener_clases_by_departamento_");

// =============== OBTENER FAMILIAS BY CLASE ================
$router->map('GET', "$entidad/obtener_familias/by_clase/", function(){
    global $db;
    $clase = (int) $_REQUEST["clase"];
    $query = "CALL obtenerFamiliasPorClas(".$clase.");";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all(MYSQLI_ASSOC);
    $response["response"] = "success";
    print_r(json_encode($response));
}, $entidad."_obtener_familias_by_clase_");

// ============== DAR DE ALTA PRODUCTOS =================
$router->map('POST', "$entidad/alta_productos_tienda/", function(){
    global $db;
    $json = file_get_contents("php://input");
    $info = json_decode($json);
    $response["response"] = "success";
    $query = "CALL altaProductos(".$info->DEPARTAMENTO.",".$info->CLASE.",".$info->FAMILIA.",".$info->SKU.",'".$info->ARTICULO."','".$info->MARCA."','".$info->MODELO."',".$info->STOCK.",".$info->CANTIDAD.");";
    if(!$db->query($query)){
        $response = ["response" => "error", "info" => $db->error_list];
    }else{
        $response["info"] = "All good";
    }
    print_r(json_encode($response));
}, $entidad."_alta_productos_tienda_");

// =================== DAR DE BAJA PRODUCTOS ====================
$router->map('PUT', "$entidad/dar_baja/producto/", function(){
    global $db;
    $sku = $_REQUEST["sku"];
    $response = ["response" => "success", "informacion" => "Producto actualizado correctamente"];
    $query = "CALL bajaProductos(".$sku.");";
    if(!$db->query($query)){
        $response = ["response" => "error", "informacion" => $db->error_list];
    }
    print_r(json_encode($response));
}, $entidad."_dar_baja_producto_");

// =================== OBTENER INFO DE PRODUCTO P. EDITAR ===================
$router->map('GET', "$entidad/get_info_producto/", function(){
    global $db;
    $sku = $_REQUEST["sku"];
    $response["response"] = "success";
    $query = "CALL consultaProductosCambio(".$sku.");";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all(MYSQLI_ASSOC);
    print_r(json_encode($response));
}, $entidad."_get_info_producto_");

// =================== CAMBIO DE INFORMACION PRODUCTO ======================
$router->map('PUT', "$entidad/update_informacion_producto/", function(){
    global $db;
    $json = file_get_contents("php://input");
    $info = json_decode($json);
    $response = ["response" => "success", "informacion" => "Producto actualizado correctamente"];
    $query = "CALL cambioProductos(".$info->DEPARTAMENTO.",".$info->CLASE.",".$info->FAMILIA.",".$info->SKU.",'".$info->ARTICULO."','".$info->MARCA."','".$info->MODELO."',".$info->STOCK.",".$info->CANTIDAD.",".$info->DESCONTINUADO.",'".$info->FECHA_ALTA."','".$info->FECHA_BAJA."');";
    if(!$db->query($query)){
        $response = ["response" => "error", "informacion" => $db->error_list];
    }
    print_r(json_encode($response));
}, $entidad."_update_informacion_producto_");

// ======================= CONSULTAR INFO PRODUCTO ========================
$router->map('GET', "$entidad/consultar_info_producto_visualizacion/", function(){
    global $db;
    $sku = $_REQUEST["sku"];
    $response["response"] = "success";
    $query = "CALL consultaProductos(".$sku.");";
    $resultado = $db->query($query);
    $response["data"] = $resultado->fetch_all(MYSQLI_ASSOC);
    print_r(json_encode($response));
}, $entidad."_consultar_info_producto_visualizacion_");
?>