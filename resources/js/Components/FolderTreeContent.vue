<template>
    <ul>
        <li v-for="child in children">
            <folder-tree @folderSelected="emitFolderSelected" v-if="child.folders.length" :folder="child"/>
            <div v-else>
                <input
                    :id="`folder-${child.id}`"
                    @input="emitFolderSelected(child.id)"
                    type="radio"
                    name="folder"
                />
                <label :for="`folder-${child.id}`">
                    <b-icon icon="folder" class="text-warning" font-scale="1.5" />
                    <span>{{ child.name }}</span>
                </label>
            </div>
        </li>
    </ul>
</template>

<script>
import EmitFolderSelectedEvent from '../Mixins/emit-folder-selected-event'

export default {
    name: "FolderTreeContent",
    mixins: [EmitFolderSelectedEvent],
    components: {
        FolderTree: () => import("./FolderTree")
    },
    props: ['children'],

}
</script>

<style scoped>
ul  {
    list-style: none;
}
</style>
