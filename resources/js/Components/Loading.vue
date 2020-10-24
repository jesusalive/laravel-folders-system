<template>
    <div class="loading-wrapper">
        <div class="d-flex align-items-center">
            <b-icon icon="arrow-counterclockwise" animation="spin-reverse" font-scale="2" />
            <span class="ml-3">Só um segundo</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Loading"
}
</script>

<style scoped>
.loading-wrapper {
    display: flex;
    height: 200px;
    justify-content: center;
    align-items: center;
    z-index: 10
}
</style>
