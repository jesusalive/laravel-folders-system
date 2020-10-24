<template>
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ folderName }}</h1>
        <div class="d-flex">
            <button class="btn-sm btn-dark mr-2" v-b-modal.add-folder-modal>+ Pasta</button>
            <button class="btn-sm btn-primary" @click="addArchive()">+ Arquivo</button>
        </div>
        <b-modal
            id="add-folder-modal"
            title="Adicionar Pasta"
            ok-title="Criar"
            button-size="sm"
            cancel-title="Cancelar"
            @ok.prevent="addFolder()"
        >
            <div v-if="!loadingAddFolder">
                <label for="folder-name">Nome:</label>
                <input type="text" v-model="newFolderName" id="folder-name" class="ml-2 px-1">
            </div>
            <div v-else>
                Carregando...
            </div>
        </b-modal>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: ['folderName', 'folderId'],
    name: "FolderHeader",
    data () {
        return {
            loadingAddFolder: false,
            newFolderName: null
        }
    },
    methods: {
        async addFolder () {
            this.loadingAddFolder = true
            await axios.post('/folders', { name: this.newFolderName, belongs_to_folder: 1 })
                .then(() => {
                    this.newFolderName = null
                    this.$emit('folderCreated')
                    this.$bvModal.hide('add-folder-modal')
                })
                .finally(() => {
                    this.loadingAddFolder = false
                })
        },
        addArchive () {}
    }
}
</script>

<style scoped>

</style>
