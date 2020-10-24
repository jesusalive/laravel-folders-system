<template>
    <default-layout>
        <div class="container p-3">
            <div v-if="!loading">
                <folder-header
                    @folderCreated="loadData()"
                    @archiveUploaded="loadData()"
                    :folder-id="1"
                    folder-name="Raiz"
                />
                <div class="mt-3">
                    <div v-if="folders.length || archives.length" class="d-flex flex-wrap">
                        <folder
                            v-for="folder of folders"
                            :key="folder.id"
                            :id="folder.id"
                            :name="folder.name"
                            class="mr-4"
                        />
                    </div>
                    <div v-else>
                        Nenhum item encontrado
                    </div>
                </div>
            </div>
            <loading v-else />
        </div>
    </default-layout>
</template>

<script>
import DefaultLayout from '../Layouts/Default'
import Loading from '../Components/Loading'
import FolderHeader from '../Components/FolderHeader'
import Folder from '../Components/Folder'
import axios from 'axios'

export default {
    name: 'Index',
    data() {
        return {
            folders: [],
            archives: [],
            loading: false
        }
    },
    methods: {
        loadData () {
            this.loading = true
            axios.get('/folders/1')
                .then(res => {
                    this.loading = false
                    const { data } = res.data

                    this.archives = data.archives
                    this.folders = data.folders
                })
        },
    },
    components: {
        DefaultLayout,
        Loading,
        FolderHeader,
        Folder
    },
    mounted () {
        this.loadData()
    }
}
</script>
