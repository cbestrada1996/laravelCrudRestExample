<template>
    <a-layout id="main-layout">
        <a-layout-header :style="{background: '#fff'}" theme="light">
            <a-menu
                theme="light"
                mode="horizontal"
                :defaultSelectedKeys="['2']"
                :style="{ lineHeight: '64px' }"
            >
                <a-menu-item key="1"><router-link :to="{ name: 'home' }">Home</router-link></a-menu-item>
                <a-menu-item key="2"> <router-link :to="{ name: 'items'}">Items</router-link></a-menu-item>
            </a-menu>
        </a-layout-header>
        <a-layout-content>
            <div class="container">
                <router-view></router-view>
            </div>
        </a-layout-content>
    </a-layout>
</template>
<script>
    export default {}
</script>
<style scoped>
.container {
    margin-left: 3%;
    margin-right: 3%;
    margin-top: 3%;
}
</style>