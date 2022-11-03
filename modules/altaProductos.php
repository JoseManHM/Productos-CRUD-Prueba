<div class="container" id="vue-content">
    <h3 class="">Alta de productos</h3>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="sku">SKU:</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" v-model="sku">
            <label class="text-danger">{{errorSku}}</label>
            <label>{{mensajeExist}}</label>
        </div>
        <div class="col-1"></div>
        <div class="col-1 text-end">
            <input type="checkbox" class="form-check-input" disabled v-model="cont">
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
            <input type="text" class="form-control" :disabled="canEdit == 0" v-model="articulo">
            <label class="text-danger">{{tamanoArticulo}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="marca">Marca:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" :disabled="canEdit == 0" v-model="marca">
            <label class="text-danger">{{tamanoMarca}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="modelo">Modelo:</label>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" :disabled="canEdit == 0" v-model="modelo">
            <label class="text-danger">{{tamanoModelo}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="departamento">Departamento:</label>
        </div>
        <div class="col-7">
            <select name="departamento" id="departamento" class="form-control datatable-input" :disabled="canEdit == 0" v-model="selectDpto" @change="obtenerClases">
                <option value="#">Selecciona un departamento</option>
                <option v-for="departamento in departamentos" :value="departamento.ID">{{departamento.DEPARTAMENTO}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="clase">Clase:</label>
        </div>
        <div class="col-7">
            <select name="clase" id="clase" class="form-control datatable-input" :disabled="canEdit == 0" v-model="selectClase" @change="obtenerFamilias">
                <option value="#">Selecciona una clase</option>
                <option v-for="clase in clases" :value="clase.ID">{{clase.CLASE}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="familia">Familia:</label>
        </div>
        <div class="col-7">
            <select name="familia" id="familia" class="form-control datatable-input" :disabled="canEdit == 0" v-model="selectFam">
                <option value="#">Selecciona una familia</option>
                <option v-for="familia in familias" :value="familia.ID">{{familia.FAMILIA}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="stock">Stock:</label>
        </div>
        <div class="col-3">
            <input type="number" class="form-control" :disabled="canEdit == 0" v-model="stock">
        </div>
        <div class="col-1 text-end">
            <label for="stock">Cantidad:</label>
        </div>
        <div class="col-3">
            <input type="number" class="form-control" :disabled="canEdit == 0" v-model="cantidad">
            <label class="text-danger">{{errorCantidad}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="fechaAlta">Fecha Alta:</label>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" disabled v-model="fecha_alta">
        </div>
        <div class="col-1 text-end">
            <label for="fechaBaja">Fecha Baja:</label>
        </div>
        <div class="col-3">
            <input type="date" class="form-control" disabled v-model="fecha_baja">
        </div>
    </div>
    <div class="form-group row mt-3">
        <div class="col-7"></div>
        <button class="btn btn-primary col-1" v-show="canEdit == 1 && validCant" @click="guardarProducto">Guardar</button>
    </div>
</div>