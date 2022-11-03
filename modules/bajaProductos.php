<div class="container" id="vue-content">
    <h3 class="">Baja de productos</h3>
    <div class="form-group row mt-3">
        <div class="col-1 text-start">
            <label for="sku">SKU:</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" v-model="sku">
            <label class="text-danger">{{errorSku}}</label>
            <label>{{infoSku}}</label>
        </div>
    </div>
    <div class="form-group row mt-3">
        <button class="btn btn-danger col-1" :disabled="!canDelete" @click="darDeBajaProducto">Eliminar</button>
    </div>
</div>