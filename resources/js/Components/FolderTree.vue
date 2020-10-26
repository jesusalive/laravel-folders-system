<template>
    <div>
        <input
            :id="`folder-${folder.id}`"
            @input="emitFolderSelected(folder.id)"
            type="radio"
            v-if="folderIdToDisable != folder.id && !folderHasChildDisabled()"
            name="folder"
        />
        <label :for="`folder-${folder.id}`">
            <b-icon icon="folder" class="text-warning" font-scale="1.5" />
            <span>{{ folder.name }}</span>
        </label>
        <folder-tree-content
            v-if="folderIdToDisable != folder.id"
            :folder-id-to-disable="folderIdToDisable"
            @folderSelected="emitFolderSelected"
            :children="folder.folders"
        />
    </div>
</template>

<script>
import FolderTreeContent from "./FolderTreeContent"
import EmitFolderSelectedEvent from '../Mixins/emit-folder-selected-event'

export default {
    name: "FolderTree",
    mixins: [EmitFolderSelectedEvent],
    components: {FolderTreeContent},
    methods: {
        folderHasChildDisabled () {
            let hasChildDisabled = false

            this.folder.folders.map(folder => {
                if (folder.id == this.folderIdToDisable)
                    hasChildDisabled = true
            })

            return hasChildDisabled
        }
    },
    props: ['folder', 'folderIdToDisable']
}
</script>

<style scoped>

</style>
