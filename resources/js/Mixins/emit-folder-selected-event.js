export default {
    methods: {
        emitFolderSelected (id) {
            this.$emit('folderSelected', id)
        }
    }
}
