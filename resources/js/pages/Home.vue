<template>
    <div>
        <h2>Products</h2>

        <div v-if="status && products.length === 0" class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>There is no product yet!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div v-if="message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div v-if="deleteProductMessage" class="alert alert-dismissible fade show" v-bind:class="[!statusDelete ? 'alert-danger' : 'alert-success']" role="alert">
            <strong>{{ deleteProductMessage }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-4 my-2" v-for="product in products">
                <div class="card" style="">
<!--                    <img class="card-img-top" :src="product.image" alt="Card image cap">-->
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                <router-link :disabled="loadingDeleteProduct"  :to="'/edit-product/' + product.id" class="btn btn-primary float-right float-md-left float-lg-left float-xl-left">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                </router-link>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6 col-xl-6 mt-3 mt-md-0 mt-lg-0 mt-xl-0">
                                <button :disabled="loadingDeleteProduct" v-on:click="deleteItem(product.id)" class="btn btn-danger float-right">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            products: [],
            status: null,
            message: null,
            statusDelete: false,
            loadingDeleteProduct: false,
            deleteProductMessage: null
        }
    },
    mounted: async function() {
        await this.getProducts();
    },
    methods: {
        async deleteItem(id) {
            try {
                this.loadingDeleteProduct = true;
                const { status, message} = await fetch(`http://127.0.0.1:8000/api/products/item/${id}`,
                    {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(res => res.json());

                if (status) {
                    let i = this.products.map(item => item.id).indexOf(id); // find index of your object
                    this.products.splice(i, 1)
                }
                this.statusDelete = status;
                this.loadingDeleteProduct = false;
                this.deleteProductMessage = message;
            } catch (err) {
                console.log(err);
            }
        },

        async getProducts() {
            try {
                const { status, products, message } = await fetch('http://127.0.0.1:8000/api/products/list').then(res => res.json());
                this.status = status;
                if (status) {
                    this.products = products
                }

                if (!status) {
                    this.message = message;
                }
            } catch (err) {
                console.log(err);
            }
        }
    }
}
</script>

<style scoped>

</style>
