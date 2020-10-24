<template>
    <div class="d-flex" :class="{'mr-5': !showOptions}">
        <div class="position-relative">
            <div class="d-flex flex-column justify-content-center text-center cursor-pointer folder-item">
                <b-icon icon="file-earmark" class="text-muted mx-auto" font-scale="3" />
                <span>{{ file.name }}</span>
                <small class="data-upload">{{ uploadedDate }}</small>
            </div>
            <div @click="toogleOptions()" class="folder-item-options bg-primary rounded px-1 cursor-pointer">
                <b-icon icon="three-dots" class="text-light" />
            </div>
        </div>
        <div v-if="showOptions">
            <ul class="ml-1 list-group">
                <li class="list-group-item">Excluir</li>
                <li class="list-group-item">Renomear</li>
                <li class="list-group-item">Mover</li>
            </ul>
        </div>
    </div>
</template>

<script>
import HandleItemOptions from '../Mixins/handle-item-options'
import moment from 'moment'

export default {
    props: ['file'],
    mixins: [HandleItemOptions],
    computed: {
        uploadedDate () {
            return `Upload em ${moment(this.file.created_at).format('DD/MM/YYYY HH:mm')}`
        }
    },
    name: "File"
}
</script>

<style scoped>
.data-upload {
    font-size: 10px;
}
</style>
