<template>
    <div class="d-flex">
        <div class="position-relative">
            <inertia-link
                as="div"
                :href="`/subfolder/${id}`"
                class="d-flex flex-column text-center cursor-pointer folder"
            >
                <img src="/img/folder.png" alt="Folder" class="icon mx-auto">
                <span>{{ name }}</span>
            </inertia-link>
            <div class="folder-options bg-primary rounded px-1 cursor-pointer">
                <b-icon icon="three-dots" class="text-light" @click="toogleOptions()" />
            </div>
        </div>
        <div v-if="showOptions">
            <ul class="ml-1 list-group">
                <li class="list-group-item">Excluir</li>
                <li class="list-group-item">Renomear</li>
                <li class="list-group-item">Mover</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['id', 'name'],
    data () {
        return {
            showOptions: false
        }
    },
    methods: {
        toogleOptions () {
            this.showOptions = !this.showOptions
        }
    },
    name: "Folder"
}
</script>

<style scoped>
.folder img {
    transition: all 500ms;
}

.folder:hover img {
    height: 80px;
    width: 80px;
}

.icon {
    height: 60px;
    width: 60px;
}

.cursor-pointer {
    cursor: pointer;
}

.folder-options {
    position: absolute;
    top: -10px;
    right: 0;
}

.list-group-item {
    cursor: pointer;
    font-size: 13px !important;
}

.list-group-item:hover {
    background-color: #007bff;
    color: #eee;
}
</style>
