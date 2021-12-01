<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-8">
            <h2 class="title">Create Product</h2>

            <div v-if="message" class="alert alert-dismissible fade show" v-bind:class="[!status ? 'alert-danger' : 'alert-success']" role="alert">
                <strong>{{ message }}</strong>
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
                <button type="submit" class="btn btn-primary" :disabled="loading">{{ loading ? 'Loading...' : 'Submit' }}</button>
            </form>
        </div>
    </div>

</template>

<script>
export default {
    name: "CreateProduct",
    data() {
        return {
            loading: false,
            product: {},
            status: null,
            message: null
        }
    },
    methods: {
        async storeProduct() {
            try {
                this.loading = true;
                const {status, message} = await fetch('http://127.0.0.1:8000/api/products/create',
                    {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(this.product)
                    }).then(res => res.json());
                this.status = status;
                this.message = message;

                this.product = {};
                this.loading = false;

                await this.$router.push({ name: "home"});
            } catch (err) {
                console.log(err);
            }
        }
    }
}
</script>

<style scoped>

</style>
