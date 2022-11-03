let app = new Vue({
    el: '#vue-content',
    data: {
        canEdit: 0,
        sku: "",
        errorSku: "",
        departamentos: [],
        selectDpto: "#",
        clases: [],
        selectClase: "#",
        familias: [],
        selectFam: "#",
        cont: false,
        articulo: "",
        marca: "",
        modelo: "",
        stock: 0,
        cantidad: 0,
        fecha_alta: moment().format('YYYY-MM-DD'),
        fecha_baja: '1900-01-01',
        errorCantidad: "",
        validCant: true,
        tamanoMarca: "",
        tamanoArticulo: "",
        tamanoModelo: "",
        mensajeExist: ""
    },
    watch: {
        async sku(){
            if(isNaN(this.sku)){
                this.errorSku = "Ingresa un número";
                this.tamanoMarca = "";
                this.tamanoArticulo = "";
                this.tamanoModelo = "";
                this.mensajeExist = "";
            }else if(this.sku == ""){
                this.canEdit = 0;
                this.tamanoMarca = "";
                this.tamanoArticulo = "";
                this.tamanoModelo = "";
                this.mensajeExist = "";
            }else{
                this.errorSku = "";
                await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/verify_sku_existente/?sku="+this.sku)
                .then(response => {
                        //console.log(response);
                        if(response.data.data[0] == "1"){
                            this.canEdit = 0;
                            this.mensajeExist = "Ya existe un producto con este SKU";
                        }else{
                            this.canEdit = 1;
                            this.obtenerDepartamentos();
                        }
                }).catch(error => {
                        console.log(error);
                });
            }
        },
        cantidad(){
            if(this.cantidad > this.stock){
                this.errorCantidad = "La cantidad no puede ser mayor al stock";
                this.validCant = false;
            }else{
                this.errorCantidad = "";
                this.validCant = true;
            }
        },
        marca(){
            this.tamanoMarca = "";
            if(this.marca.length > 15){
                this.tamanoMarca = "Máximo 15 caracteres contando espacios";
            }
        },
        articulo(){
            this.tamanoArticulo = "";
            if(this.articulo.length > 15){
                this.tamanoArticulo = "Máximo 15 caractres contando espacios";
            }
        },
        modelo(){
            this.tamanoModelo = "";
            if(this.modelo.length > 20){
                this.tamanoModelo = "Máximo 20 caracteres contando espacios"
            }
        }
    },
    methods: {
        async obtenerDepartamentos(){
            await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/obtener_departamentos/")
            .then(response => {
                //console.log(response);
                this.departamentos = response.data.data;
            }).catch(error => {
                console.log(error);
            });
        },
        async obtenerClases(){
            if(this.selectDpto != "#"){
                await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/obtener_clases/by_departamento/?dpto="+this.selectDpto)
                .then(response => {
                    //console.log(response);
                    this.clases = response.data.data;
                }).catch(error => {
                    console.log(error);
                });
            }
            if(this.selectClase == "#"){
                this.selectFam = "#";
                this.familias = [];
            }
        },
        async obtenerFamilias(){
            if(this.selectClase != "#"){
                await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/obtener_familias/by_clase/?clase="+this.selectClase)
                .then(response => {
                    //console.log(response);
                    this.familias = response.data.data;
                }).catch(error => {
                    console.log(error);
                });
            }else{
                this.selectFam = "#";
                this.familias = [];
            }
        },
        async guardarProducto(){
            let post_data = {
                DEPARTAMENTO: this.selectDpto,
                CLASE: this.selectClase,
                FAMILIA: this.selectFam,
                SKU: this.sku,
                ARTICULO: this.articulo,
                MARCA: this.marca,
                MODELO: this.modelo,
                STOCK: this.stock,
                CANTIDAD: this.cantidad
            };
            await axios.post("http://localhost/PruebaT-Coppel/api/public/productos/alta_productos_tienda/",post_data)
            .then(response => {
                console.log(response);
                if(response.data.response == "success"){
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Producto dado de alta correctamente',
                        icon: 'success',
                        textButtonConfirm: 'Aceptar'
                    }).then(value => {
                        if(value.isConfirmed){
                            location.reload();
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No se ha podido dar de alta el producto',
                        icon: 'error',
                    });
                }
            }).catch(error => {
                console.log(error);
            });
        }
    },
});