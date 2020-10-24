<template>
    <div>
        <header class="bg-dark p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                <img src="/img/plenus-white.png" alt="Logo" class="logo">
                <span class="text-light font-weight-bold">SISTEMA DE ARQUIVOS WEB</span>
            </div>
        </header>
        <slot></slot>
    </div>
</template>

<script>
export default {
name: "Default.vue"
}
</script>

<style scoped>
.logo {
    width: 200px;
}
</style>
