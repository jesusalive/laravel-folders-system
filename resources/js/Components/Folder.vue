<template>
    <div class="d-flex">
        <div class="position-relative">
            <inertia-link
                as="div"
                :href="`/subfolder/${folder.id}`"
                class="d-flex flex-column justify-content-center text-center cursor-pointer folder-item"
            >
                <div class="text-center">
                    <b-icon icon="folder" class="text-warning" font-scale="3" />
                </div>
                <span>{{ folder.name }}</span>
            </inertia-link>
            <div @click="toogleOptions()" class="folder-item-options bg-primary rounded px-1 cursor-pointer">
                <b-icon icon="three-dots" class="text-light" />
            </div>
        </div>
        <div v-if="showOptions">
            <ul class="ml-1 list-group">
                <li class="list-group-item" v-b-modal="`delete-folder-${this.folder.id}`">Excluir</li>
                <li class="list-group-item" v-b-modal="`rename-folder-${this.folder.id}`">Renomear</li>
                <li class="list-group-item" v-b-modal="`move-folder-${this.folder.id}`">Mover</li>
            </ul>
        </div>
        <b-modal
            :id="`rename-folder-${this.folder.id}`"
            centered
            title="Renomear Pasta"
            ok-title="Confirmar"
            button-size="sm"
            cancel-title="Cancelar"
            @ok.prevent="renameFolder()"
        >
            <div v-if="!loading">
                <label for="folder-name">Nome:</label>
                <input type="text" v-model="newName" id="folder-name" class="ml-2 px-1">
            </div>
            <div v-else>
                Carregando...
            </div>
        </b-modal>
        <b-modal
            :id="`delete-folder-${this.folder.id}`"
            centered
            title="Remover pasta"
            hide-footer
        >
            <div class="d-flex flex-column justify-content-center text-center">
                <span>Tem certeza que deseja remover essa pasta e o seu conteúdo?</span>
                <div class="mt-3">
                    <button class="btn btn-primary" @click="removeFolder()">
                        {{ loading ? 'Carregando...' : 'Sim, apagar' }}
                    </button>
                </div>
            </div>
        </b-modal>
        <select-folder-modal
            :modal-id="`move-folder-${this.folder.id}`"
            title="Mover pasta para"
            :loading="loadingMove"
            :folder-id-to-disable="folder.id"
            :ok-function="moveFolder"
        />
    </div>
</template>

<script>
import HandleItemOptions from "../Mixins/handle-item-options"
import axios from 'axios'
import SelectFolderModal from "./SelectFolderModal"

export default {
    components: {SelectFolderModal},
    props: ['folder'],
    data () {
        return {
            loadingMove: false,
            loading: false,
            newName: null
        }
    },
    methods: {
        moveFolder (selectedFolder) {
            this.loadingMove = true
            axios.put(`/folders/${this.folder.id}`, { belongs_to_folder: selectedFolder })
                .then(() => {
                    this.$emit('needsReload')
                })
                .finally(() => {
                    this.loadingMove = false
                })
        },
        renameFolder () {
            this.loading = true
            axios.put(`/folders/${this.folder.id}`, { name: this.newName })
                .then((res) => {
                    this.$emit('needsReload')
                    this.newName = null
                })
                .finally(() => {
                    this.loading = false
                })
        },
        removeFolder () {
            this.loading = true
            axios.delete(`/folders/${this.folder.id}`)
                .then((res) => {
                    this.$emit('needsReload')
                })
                .finally(() => {
                    this.loading = false
                })
        }
    },
    mixins: [HandleItemOptions],
    name: "Folder"
}
</script>

<style scoped>
</style>
