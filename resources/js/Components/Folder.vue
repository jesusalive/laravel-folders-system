<template>
    <div class="d-flex" :class="[showOptions ? 'mr-2' : 'mr-5']">
        <div class="position-relative">
            <inertia-link
                as="div"
                :href="`/subfolder/${id}`"
                class="d-flex flex-column text-center cursor-pointer folder-item"
            >
                <b-icon icon="folder" class="text-warning" font-scale="3" />
                <span>{{ folderName }}</span>
            </inertia-link>
            <div @click="toogleOptions()" class="folder-item-options bg-primary rounded px-1 cursor-pointer">
                <b-icon icon="three-dots" class="text-light" />
            </div>
        </div>
        <div v-if="showOptions">
            <ul class="ml-1 list-group">
                <li class="list-group-item" v-b-modal.delete-folder>Excluir</li>
                <li class="list-group-item" v-b-modal.rename-folder>Renomear</li>
                <li class="list-group-item">Mover</li>
            </ul>
        </div>
        <b-modal
            id="rename-folder"
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
            id="delete-folder"
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
    </div>
</template>

<script>
import HandleItemOptions from "../Mixins/handle-item-options"
import axios from 'axios'

export default {
    props: ['id', 'name'],
    data () {
        return {
            loading: false,
            newName: null
        }
    },
    methods: {
        renameFolder () {
            this.loading = true
            axios.put(`/folders/${this.id}`, { name: this.newName })
                .then((res) => {
                    this.folderName = this.newName
                    this.showOptions = false
                    this.newName = null
                    this.$bvModal.hide('rename-folder')
                })
                .finally(() => {
                    this.loading = false
                })
        },
        removeFolder () {
            this.loading = true
            axios.delete(`/folders/${this.id}`)
                .then((res) => {
                    this.$emit('folderRemoved')
                })
                .finally(() => {
                    this.loading = false
                })
        }
    },
    mixins: [HandleItemOptions],
    name: "Folder",
    created () {
        this.folderName = this.name
    }
}
</script>

<style scoped>
</style>
