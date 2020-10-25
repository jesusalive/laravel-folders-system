<template>
    <b-modal
        :id="modalId"
        centered
        :title="title"
        ok-title="Confirmar"
        button-size="sm"
        cancel-title="Cancelar"
        @ok.prevent="okFunction(folderSelected)"
        :ok-disabled="!folderSelected"
    >
        <div v-if="!loading && !innerLoading">
            <folder-tree :folder="folders" @folderSelected="folderSelected = $event" />
        </div>
        <div v-else>
            Carregando...
        </div>
    </b-modal>
</template>

<script>
import axios from 'axios'
import FolderTree from "./FolderTree";

export default {
    components: {FolderTree},
    props: ['modalId', 'title', 'okFunction', 'loading'],
    data () {
        return {
            innerLoading: true,
            folderSelected: null,
            folders: []
        }
    },
    created () {
        axios.get('/folders/1')
            .then(res => {
                this.folders = res.data.data
            })
            .finally(() => {
                this.innerLoading = false
            })
    },
    name: "SelectFolderModal"
}
</script>

<style scoped>

</style>
