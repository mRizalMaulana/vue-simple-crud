<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
        <div class="container">
            <router-link class="navbar-brand" to="/">
                <h3 class="p-0 m-0">PRODUCT APP</h3>
            </router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link class="nav-link font-weight-bold" to="/">Home</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link font-weight-bold" to="/create-product">Create Product</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<!--    <nav class="navbar is-success" role="navigation" aria-label="main navigation">-->
<!--        <div class="container">-->
<!--            <div class="navbar-brand">-->
<!--                <router-link class="navbar-item" to="/">-->
<!--                    <h3 class="title is-3 m-0 p-0">PRODUCT APP</h3>-->
<!--                </router-link>-->

<!--                <a v-on:click="isShow = !isShow" role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">-->
<!--                    <span aria-hidden="true"></span>-->
<!--                    <span aria-hidden="true"></span>-->
<!--                    <span aria-hidden="true"></span>-->
<!--                </a>-->
<!--            </div>-->

<!--            <div id="navbarBasicExample" class="navbar-menu" :class="{ 'is-active': isShow }">-->
<!--                <div class="navbar-end">-->
<!--                    <router-link class="navbar-item" to="/">-->
<!--                        Home-->
<!--                    </router-link>-->

<!--                    <router-link class="navbar-item" to="/create-product">-->
<!--                        Create Product-->
<!--                    </router-link>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
</template>

<script>
export default {
    name: "Navbar",
    data: () => {
        return {
            isShow: null
        }
    }
}
</script>
