<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-8">
            <h2 class="title">Update Product</h2>

            <div v-if="getProductErrMessage" class="alert alert-dismissible fade show alert-danger" role="alert">
                <strong>{{ getProductErrMessage }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div v-if="messageCreate" class="alert alert-dismissible fade show" v-bind:class="[!statusCreate ? 'alert-danger' : 'alert-success']" role="alert">
                <strong>{{ messageCreate }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form v-on:submit.prevent="storeProduct">
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input name="name" type="text" class="form-control" id="productName" v-model="product.name" required>
                </div>
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" v-model="product.description" required>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="loadingGetProduct || loadingCreate">{{ loadingCreate ? 'Loading...' : 'Submit' }}</button>
            </form>
        </div>
    </div>

</template>

<script>
export default {
    name: "EditProduct",
    data() {
        return {
            loadingGetProduct: false,
            product: {},
            getProductErrMessage: null,
            loadingCreate: false,
            messageCreate: null,
            statusCreate: false
        }
    },
    mounted: async function () {
        await this.getProduct();
    },
    methods: {
        async getProduct() {
            try {
                this.loadingGetProduct = false;
                const {status, product, errMessage} = await fetch(`http://127.0.0.1:8000/api/products/item/${this.$route.params.id}`).then(res => res.json());
                if (status) {
                    this.product = product;
                }
                this.getProductErrMessage = errMessage;
                this.loadingGetProduct = false;
            } catch (err) {
                console.log(err);
            }
        },
        async storeProduct() {
            try {
                this.loadingCreate = true;
                const {status, message} = await fetch(`http://127.0.0.1:8000/api/products/item/${this.$route.params.id}`,
                    {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.product)
                    }).then(res => res.json());
                this.statusCreate = status;
                this.messageCreate = message;

                this.product = {};
                this.loadingCreate = false;

                await this.$router.push({ name: "home"});
            } catch (err) {
                console.log(err);
            }
        }
    }
}
</script>
