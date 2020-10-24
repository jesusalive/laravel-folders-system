<template>
    <div class="d-flex" :class="[showOptions ? 'mr-2' : 'mr-5']">
        <div class="position-relative">
            <inertia-link
                as="div"
                :href="`/subfolder/${id}`"
                class="d-flex flex-column text-center cursor-pointer folder-item"
            >
                <b-icon icon="folder" class="text-warning" font-scale="3" />
                <span>{{ name }}</span>
            </inertia-link>
            <div @click="toogleOptions()" class="folder-item-options bg-primary rounded px-1 cursor-pointer">
                <b-icon icon="three-dots" class="text-light" />
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
import HandleItemOptions from "../Mixins/handle-item-options";

export default {
    props: ['id', 'name'],
    mixins: [HandleItemOptions],
    name: "Folder"
}
</script>

<style scoped>
</style>
