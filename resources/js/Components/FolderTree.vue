<template>
    <div>
        <input :id="`folder-${folder.id}`" @input="emitFolderSelected(folder.id)" type="radio" name="folder">
        <label :for="`folder-${folder.id}`">
            <b-icon icon="folder" class="text-warning" font-scale="1.5" />
            <span>{{ folder.name }}</span>
        </label>
        <folder-tree-content @folderSelected="emitFolderSelected" :children="folder.folders"/>
    </div>
</template>

<script>
import FolderTreeContent from "./FolderTreeContent"
import EmitFolderSelectedEvent from '../Mixins/emit-folder-selected-event'

export default {
    name: "FolderTree",
    mixins: [EmitFolderSelectedEvent],
    components: {FolderTreeContent},
    props: ['folder']
}
</script>

<style scoped>

</style>
