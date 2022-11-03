let app = new Vue({
    el: '#vue-content',
    data: {
        sku: "",
        errorSku: "",
        canEdit: false,
        infoSku: "",
        producto: {},
        infoSkuBaja: "",
        selectDpto: "",
        selectClase: "",
        selectFam: "",
        departamentos: [],
        clases: [],
        familias: [],
        tamanoArticulo: "",
        tamanoMarca: "",
        tamanoModelo: ""
    },
    watch: {
        async sku(){
            if(isNaN(this.sku)){
                this.errorSku = "Ingresa un número";
                this.canEdit = false;
                this.infoSku = "";
                this.infoSkuBaja = "";
                this.producto = [];
                this.selectFam = "";
                this.selectClase = "";
                this.selectDpto = "";
                this.tamanoArticulo = "";
                this.tamanoMarca = "";
                this.tamanoModelo = "";
            }else if(this.sku == ""){
                this.canEdit = false;
                this.errorSku = "";
                this.infoSku = "";
                this.infoSkuBaja = "";
                this.producto = [];
                this.selectFam = "";
                this.selectClase = "";
                this.selectDpto = "";
                this.tamanoArticulo = "";
                this.tamanoMarca = "";
                this.tamanoModelo = "";
            }else{
                this.errorSku = "";
                await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/verify_sku_existente/?sku="+this.sku)
                .then(response => {
                        //console.log(response);
                        if(response.data.data[0] == "1"){
                            this.canEdit = true;
                            this.infoSku = "";
                            this.obtenerInfoProducto();
                        }else{
                            this.canEdit = false;
                            this.infoSku = "Sku no encontrado";
                            this.infoSkuBaja = "";
                            this.producto = [];
                            this.selectFam = "";
                            this.selectClase = "";
                            this.selectDpto = "";
                            this.tamanoArticulo = "";
                            this.tamanoMarca = "";
                            this.tamanoModelo = "";
                        }
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        'producto.ARTICULO'(){
            this.tamanoArticulo = "";
            if(this.producto.ARTICULO.length > 15){
                this.tamanoArticulo = "Máximo 15 caracteres contando espacios";
            }
        },
        'producto.MODELO'(){
            this.tamanoModelo = "";
            if(this.producto.MODELO.length > 20){
                this.tamanoModelo = "Máximo 20 caracteres contando espacios";
            }
        },
        'producto.MARCA'(){
            this.tamanoMarca = "";
            if(this.producto.MARCA.length > 15){
                this.tamanoMarca = "Máximo 15 caracteres contando caracteres";
            }
        }
    },
    methods: {
        async obtenerInfoProducto(){
            this.infoSkuBaja = "";
            await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/get_info_producto/?sku="+this.sku)
            .then(response => {
                //console.log(response);
                if(response.data.data[0]){
                    this.producto = response.data.data[0];
                }else{
                    this.canEdit = false;
                    this.infoSkuBaja = "Este producto fue dado de baja";
                }
                if(this.producto){
                    this.selectDpto = this.producto.ID_DEP;
                    this.selectClase = this.producto.ID_CLAS;
                    this.selectFam = this.producto.ID_FAM;
                    this.producto.DESCONTINUADO == "1" ? this.producto.DESCONTINUADO = true : this.producto.DESCONTINUADO = false;
                    this.obtenerDepartamentos();
                    this.obtenerClases();
                    this.obtenerFamilias();
                }
            }).catch(error => {
                console.log(error);
            });
        },
        async obtenerDepartamentos(){
            await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/obtener_departamentos/")
            .then(response => {
                this.departamentos = response.data.data;
            }).catch(error => {
                console.log(error);
            });
        },
        async obtenerClases(){
            //this.selectClase = "#";
            await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/obtener_clases/by_departamento/?dpto="+this.selectDpto)
            .then(response => {
                this.clases = response.data.data;
            }).catch(error => {
                console.log(error);
            });
        },
        async obtenerFamilias(){
            //this.selectFam = "#";
            await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/obtener_familias/by_clase/?clase="+this.selectClase)
            .then(response => {
                this.familias = response.data.data;
            }).catch(error => {
                console.log(error);
            });
        },
        cambioEstadoDesc(){
            if(this.producto.DESCONTINUADO){
                this.producto.FECHA_BAJA = moment().format('YYYY-MM-DD');
            }else{
                this.producto.FECHA_BAJA = '1900-01-01';
            }
        },
        async cambiarInfoProducto(){
            let put_data = {
                DEPARTAMENTO: this.selectDpto,
                CLASE: this.selectClase,
                FAMILIA: this.selectFam,
                SKU: this.sku,
                ARTICULO: this.producto.ARTICULO,
                MARCA: this.producto.MARCA,
                MODELO: this.producto.MODELO,
                STOCK: this.producto.STOCK,
                CANTIDAD: this.producto.CANTIDAD,
                DESCONTINUADO: this.producto.DESCONTINUADO ? 1 : 0,
                FECHA_ALTA: this.producto.FECHA_ALTA,
                FECHA_BAJA: this.producto.FECHA_BAJA
            }
            await axios.put("http://localhost/PruebaT-Coppel/api/public/productos/update_informacion_producto/",put_data)
            .then(response => {
                console.log(response);
                if(response.data.response == "success"){
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Producto actualizado correctamente',
                        icon: 'success',
                        textConfirmButton: 'Aceptar'
                    }).then(value => {
                        if(value.isConfirmed){
                            location.reload();
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No se ha podido actualizar el producto',
                        icon: 'error',
                        textConfirmButton: 'Aceptar'
                    });
                }
            }).catch(error => {
                console.log(error);
            });
        }
    },
});