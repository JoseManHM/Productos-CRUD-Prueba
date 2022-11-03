let app = new Vue({
    el: '#vue-content',
    data: {
        sku: "",
        errorSku: "",
        infoSku: "",
        producto: {},
    },
    watch: {
        async sku(){
            if(isNaN(this.sku)){
                this.errorSku = "Ingresa un número";
                this.producto = {};
                this.infoSku = "";
            }else if(this.sku == ""){
                this.producto = {};
                this.infoSku = "";
            }else{
                this.errorSku = "";
                await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/verify_sku_existente/?sku="+this.sku)
                .then(response => {
                        if(response.data.data[0] == "1"){
                            this.infoSku = "";
                            this.obtenerInfoProducto();
                        }else{
                            this.infoSku = "Sku no encontrado";
                            this.producto = {};
                        }
                }).catch(error => {
                    console.log(error);
                });
            }
        },
    },
    methods: {
        async obtenerInfoProducto(){
            await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/consultar_info_producto_visualizacion/?sku="+this.sku)
            .then(response => {
                this.producto = response.data.data[0];
                this.producto.DESCONTINUADO == "1" ? this.producto.DESCONTINUADO = true : this.producto.DESCONTINUADO = false;
            }).catch(error => {
                console.log(error);
            });
        }
    },
});