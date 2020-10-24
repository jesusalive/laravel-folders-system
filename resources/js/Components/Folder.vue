<template>
    <div class="d-flex flex-column text-center cursor-pointer folder">
        <img src="/img/folder.png" alt="Folder" class="icon">
        <span>{{ name }}</span>
    </div>
</template>

<script>
export default {
    props: ['id', 'name'],
    name: "Folder"
}
</script>

<style scoped>
.folder img {
    transition: all 500ms;
}

.folder:hover img {
    height: 80px;
}

.icon {
    height: 60px;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
