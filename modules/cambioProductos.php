<div class="container" id="vue-content">
    <h3 class="">Cambio de productos</h3>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="sku">SKU:</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" v-model="sku">
            <label class="text-danger">{{errorSku}}</label>
            <label>{{infoSku}}</label>
            <label class="text-warning">{{infoSkuBaja}}</label>
        </div>
        <div class="col-1"></div>
        <div class="col-1 text-end">
            <input type="checkbox" class="form-check-input" v-model="producto.DESCONTINUADO" @change="cambioEstadoDesc">
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
            <input type="text" class="form-control" v-model="producto.ARTICULO">
            <label class="text-danger">{{tamanoArticulo}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="marca">Marca:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.MARCA">
            <label class="text-danger">{{tamanoMarca}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="modelo">Modelo:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" v-model="producto.MODELO">
            <label class="text-danger">{{tamanoModelo}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="departamento">Departamento:</label>
        </div>
        <div class="col-7">
            <select name="departamento" id="departamento" class="form-control datatable-input" v-model="selectDpto" @change="obtenerClases">
                <option v-for="departamento in departamentos" :value="departamento.ID">{{departamento.DEPARTAMENTO}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="clase">Clase:</label>
        </div>
        <div class="col-7">
            <select name="clase" id="clase" class="form-control datatable-input" v-model="selectClase" @change="obtenerFamilias">
                <option v-for="clase in clases" :value="clase.ID">{{clase.CLASE}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="familia">Familia:</label>
        </div>
        <div class="col-7">
            <select name="familia" id="familia" class="form-control datatable-input" v-model="selectFam">
                <option v-for="familia in familias" :value="familia.ID">{{familia.FAMILIA}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="stock">Stock:</label>
        </div>
        <div class="col-3">
            <input type="number" class="form-control" v-model="producto.STOCK">
        </div>
        <div class="col-1 text-end">
            <label for="stock">Cantidad:</label>
        </div>
        <div class="col-3">
            <input type="number" class="form-control" v-model="producto.CANTIDAD">
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="fechaAlta">Fecha Alta:</label>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" v-model="producto.FECHA_ALTA">
        </div>
        <div class="col-1 text-end">
            <label for="fechaBaja">Fecha Baja:</label>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" v-model="producto.FECHA_BAJA" :disabled="!producto.DESCONTINUADO">
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-7"></div>
        <button class="btn btn-primary col-1" :disabled="!canEdit" @click="cambiarInfoProducto">Actualizar</button>
    </div>
</div>