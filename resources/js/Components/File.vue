<template>
    <div class="d-flex" :class="{'mr-5': !showOptions}">
        <div class="position-relative">
            <div class="d-flex flex-column justify-content-center text-center cursor-pointer folder-item">
                <b-icon icon="file-earmark" class="text-muted mx-auto" font-scale="3" />
                <span>{{ fileName }}</span>
                <small class="data-upload">{{ uploadedDate }}</small>
            </div>
            <div @click="toogleOptions()" class="folder-item-options bg-primary rounded px-1 cursor-pointer">
                <b-icon icon="three-dots" class="text-light" />
            </div>
        </div>
        <div v-if="showOptions">
            <ul class="ml-1 list-group">
                <li class="list-group-item" v-b-modal.delete-file>Excluir</li>
                <li class="list-group-item" v-b-modal.rename-file>Renomear</li>
                <li class="list-group-item">Mover</li>
                <li class="list-group-item" @click="downloadFile()">Download</li>
            </ul>
        </div>
        <b-modal
            id="rename-file"
            centered
            title="Renomear Arquivo"
            ok-title="Confirmar"
            button-size="sm"
            cancel-title="Cancelar"
            @ok.prevent="renameFile()"
        >
            <div v-if="!loading">
                <label for="file-name">Nome:</label>
                <input type="text" v-model="newName" id="file-name" class="ml-2 px-1">
            </div>
            <div v-else>
                Carregando...
            </div>
        </b-modal>
        <b-modal
            id="delete-file"
            centered
            title="Remover arquivo"
            hide-footer
        >
            <div class="d-flex flex-column justify-content-center text-center">
                <span>Tem certeza que deseja remover esse arquivo?</span>
                <div class="mt-3">
                    <button class="btn btn-primary" @click="removeFile()">
                        {{ loading ? 'Carregando...' : 'Sim, apagar' }}
                    </button>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
import HandleItemOptions from '../Mixins/handle-item-options'
import moment from 'moment'
import FileDownloader from 'js-file-download'
import axios from "axios"

export default {
    props: ['file'],
    mixins: [HandleItemOptions],
    data () {
        return {
            loading: false,
            fileName: null,
            newName: null
        }
    },
    computed: {
        uploadedDate () {
            return `Upload em ${moment(this.file.created_at).format('DD/MM/YYYY HH:mm')}`
        }
    },
    methods: {
        renameFile () {
            this.loading = true
            axios.put(`/files/${this.file.id}`, { name: this.newName })
                .then((res) => {
                    this.fileName = res.data.data.name
                    this.showOptions = false
                    this.newName = null
                    this.$bvModal.hide('rename-file')
                })
                .finally(() => {
                    this.loading = false
                })
        },
        removeFile () {
            this.loading = true
            axios.delete(`/files/${this.file.id}`)
                .then((res) => {
                    this.$emit('fileRemoved')
                })
                .finally(() => {
                    this.loading = false
                })
        },
        downloadFile () {
            const filePath = String(this.file.path).replace('public/', 'storage/')

            axios({
                url: '/' + filePath,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                FileDownloader(new Blob([response.data]), this.fileName)
            })

            this.showOptions = false
        }
    },
    created () {
        this.fileName = this.file.name
    },
    name: "File"
}
</script>

<style scoped>
.data-upload {
    font-size: 10px;
}
</style>
