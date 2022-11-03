let app = new Vue({
    el: '#vue-content',
    data: {
        sku: "",
        errorSku: "",
        canDelete: false,
        infoSku: ""
    },
    watch: {
        async sku(){
            if(isNaN(this.sku)){
                this.errorSku = "Ingresa un número";
                this.canDelete = false;
                this.infoSku = "";
            }else if(this.sku == ""){
                this.canDelete = false;
                this.errorSku = "";
                this.infoSku = "";
            }else{
                this.errorSku = "";
                await axios.get("http://localhost/PruebaT-Coppel/api/public/productos/verify_sku_existente/?sku="+this.sku)
                .then(response => {
                        //console.log(response);
                        if(response.data.data[0] == "1"){
                            this.canDelete = true;
                            this.infoSku = "";
                        }else{
                            this.canDelete = false;
                            this.infoSku = "Sku no encontrado";
                        }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    },
    methods: {
        async darDeBajaProducto(){
            await axios.put("http://localhost/PruebaT-Coppel/api/public/productos/dar_baja/producto/?sku="+this.sku)
            .then(response => {
                console.log(response);
                if(response.data.response == "success"){
                    Swal.fire({
                        title: '¡Excelente!',
                        text: 'Producto dado de baja',
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
                        text: 'No se ha podido dar de baja el producto',
                        icon: 'error'
                    });
                }
            }).catch(error => {
                console.log(error);
            });
        }
    },
});