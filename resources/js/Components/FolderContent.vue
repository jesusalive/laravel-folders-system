<template>
    <div class="container p-3">
        <div v-if="!loading">
            <folder-header
                @folderCreated="loadData()"
                @archiveUploaded="loadData()"
                :folder-id="id"
                :folder-name="folderName"
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
</template>

<script>
import Loading from './Loading'
import FolderHeader from './FolderHeader'
import Folder from './Folder'
import axios from 'axios'

export default {
    name: 'Index',
    props: ['id'],
    data() {
        return {
            folders: [],
            archives: [],
            folderName: null,
            loading: false
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
                    this.archives = data.archives
                    this.folders = data.folders
                })
        },
    },
    components: {
        Loading,
        FolderHeader,
        Folder
    },
    created () {
        this.loadData()
    }
}
</script>
