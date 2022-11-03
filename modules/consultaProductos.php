<div class="container" id="vue-content">
    <h3 class="">Consulta de productos</h3>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="sku">SKU:</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" v-model="sku">
            <label class="text-danger">{{errorSku}}</label>
            <label>{{infoSku}}</label>
            <label class="text-warning" v-if="producto.ACTIVO == '0'">Este producto está dado de baja</label>
        </div>
        <div class="col-1"></div>
        <div class="col-1 text-end">
            <input type="checkbox" class="form-check-input" v-model="producto.DESCONTINUADO" disabled>
        </div>
        <div class="col-1 text-start">
            <label for="descontinuado">Descontinuado</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="articulo">Artículo:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.ARTICULO" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="marca">Marca:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.MARCA" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="modelo">Modelo:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.MODELO" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="departamento">Departamento:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.DEPARTAMENTO" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="clase">Clase:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.CLASE" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="familia">Familia:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.FAMILIA" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="stock">Stock:</label>
        </div>
        <div class="col-3">
            <input type="number" class="form-control" v-model="producto.STOCK" disabled>
        </div>
        <div class="col-1 text-end">
            <label for="stock">Cantidad:</label>
        </div>
        <div class="col-3">
            <input type="number" class="form-control" v-model="producto.CANTIDAD" disabled>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="fechaAlta">Fecha Alta:</label>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" v-model="producto.FECHA_ALTA" disabled>
        </div>
        <div class="col-1 text-end">
            <label for="fechaBaja">Fecha Baja:</label>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" v-model="producto.FECHA_BAJA" disabled>
        </div>
    </div>
</div>