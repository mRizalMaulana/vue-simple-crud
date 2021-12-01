<template>
    <div>
        <Navbar ref="navbar" />
        <div class="container" ref="content" :style="contentStyle">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navbar from "../shared/Navbar";

export default {
    components: {
        Navbar
    },
    data() {
        return {
            navBarHeight: 76
        }
    },
    mounted() {
        this.setContentMargin();
    },
    methods: {
        setContentMargin() {
            this.navBarHeight = this.$refs.navbar.$el.clientHeight + 20;
        },
    },
    computed: {
        contentStyle() {
            return {
                "margin-top": `${this.navBarHeight}px`
            };
        }
    }
}
</script>
