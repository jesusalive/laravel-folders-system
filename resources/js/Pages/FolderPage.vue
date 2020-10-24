<template>
    <default-layout>
        <div class="p-3" v-if="err">
            {{ err }}
        </div>
        <div v-else class="container p-3">
            <div v-if="!loading">
                <folder-header
                    @folderCreated="loadData()"
                    @fileUploaded="loadData()"
                    :folder-id="id"
                    :folder-name="folderName"
                />
                <div class="mt-5">
                    <div v-if="folders.length || files.length" class="d-flex flex-wrap">
                        <folder
                            @folderRemoved="loadData()"
                            v-for="folder of folders"
                            :key="folder.id"
                            :id="folder.id"
                            :name="folder.name"
                        />
                        <file
                            v-for="file of files"
                            :key="file.id"
                            :file="file"
                        />
                    </div>
                    <div v-else>
                        Nenhum item encontrado
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-center" v-if="id != 1">
                    <inertia-link href="/" class="d-flex align-items-center">
                        <b-icon icon="house" class="mr-2" />
                        <span>Ir para pasta raiz</span>
                    </inertia-link>
                </div>
            </div>
            <loading v-else />
        </div>
    </default-layout>
</template>

<script>
import FolderHeader from '../Components/FolderHeader'
import DefaultLayout from "../Layouts/Default"
import Loading from '../Components/Loading'
import Folder from '../Components/Folder'
import File from '../Components/File'
import axios from "axios";

export default {
    name: "SubFolder",
    props: ['id'],
    data () {
        return {
            folders: [],
            files: [],
            folderName: null,
            loading: false,
            err: null
        }
    },
    methods: {
        loadData () {
            this.loading = true
            axios.get(`/folders/${this.id}`)
                .then(res => {
                    this.loading = false
                    const { data } = res.data

                    this.folderName = data.name
                    this.files = data.files
                    this.folders = data.folders
                })
                .catch(error => {
                    const { errors } = error.response.data
                    let errMessage = 'Houve um erro inexperado tente novamente em instantes'

                    if (errors[0].message === 'Folder not found') {
                        errMessage = 'Pasta não encontrada'
                    }

                    this.err = errMessage
                })
        },
    },
    components: {
        FolderHeader,
        Loading,
        File,
        Folder,
        DefaultLayout
    },
    created () {
        this.loadData()
    }
}
</script>

<style scoped>

</style>
