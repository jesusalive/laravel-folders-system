<template>
    <default-layout>
        <folder-page :id="id"/>
    </default-layout>
</template>

<script>
import FolderPage from "../Components/FolderContent"
import DefaultLayout from "../Layouts/Default"

export default {
    name: "SubFolder",
    props: ['id'],
    components: {
        FolderPage,
        DefaultLayout
    }
}
</script>

<style scoped>

</style>
