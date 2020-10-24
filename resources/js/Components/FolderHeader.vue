<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ folderName }}</h1>
            <div class="d-flex">
                <button class="btn-sm btn-dark mr-2" v-b-modal.add-folder-modal>+ Pasta</button>
                <button class="btn-sm btn-primary" v-b-modal.add-file-modal>+ Arquivo</button>
            </div>
            <b-modal
                id="add-folder-modal"
                centered
                title="Adicionar Pasta"
                ok-title="Criar"
                button-size="sm"
                cancel-title="Cancelar"
                @ok.prevent="addFolder()"
            >
                <div v-if="!loading">
                    <label for="folder-name">Nome:</label>
                    <input type="text" v-model="newFolderName" id="folder-name" class="ml-2 px-1">
                </div>
                <div v-else>
                    Carregando...
                </div>
            </b-modal>
            <b-modal
                id="add-file-modal"
                centered
                title="Adicionar Arquivo"
                ok-title="Adicionar"
                button-size="sm"
                cancel-title="Cancelar"
                @ok.prevent="addFile()"
            >
                <div v-if="!loading">
                    <input type="file" @input="handleFileInput($event)" :accept="fileAllowedExtensions" />
                </div>
                <div v-else>
                    Carregando...
                </div>
            </b-modal>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: ['folderName', 'folderId'],
    name: "FolderHeader",
    data () {
        return {
            loading: false,
            fileAllowedExtensions: '.jpg,.png,.jpeg,.gif,.pdf,.doc,.docx',
            newFolderName: null,
            newFile: null
        }
    },
    methods: {
        handleFileInput (event) {
            this.newFile = event.target.files[0]
        },
        addFolder () {
            this.loading = true
            axios.post('/folders', { name: this.newFolderName, belongs_to_folder: this.folderId })
                .then(() => {
                    this.newFolderName = null
                    this.$emit('folderCreated')
                    this.$bvModal.hide('add-folder-modal')
                })
                .finally(() => {
                    this.loading = false
                })
        },
        addFile () {
            this.loading = true
            const data = new FormData()
            data.append('file', this.newFile)
            data.append('folderId', this.folderId)
            axios.post('/files', data)
                .then((res) => {
                    this.newFile = null
                    this.$emit('fileUploaded')
                    this.$bvModal.hide('add-file-modal')
                })
                .finally(() => {
                    this.loading = false
                })
        }
    }
}
</script>

<style scoped>

</style>
