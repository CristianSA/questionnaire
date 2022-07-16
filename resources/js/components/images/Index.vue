<template>
    <div>
        <v-container data-app>
            <v-toolbar
                class="mb-2 elevation-0"
            >
                <v-toolbar-title>Images</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn
                    depressed
                    dark
                    color="primary"
                    @click="addImage()"
                >
                    Create
                </v-btn>
            </v-toolbar>

            <v-dialog
                v-model="dialog"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition">
                <v-card tile>
                    <v-toolbar
                        flat
                        dark
                        color="primary"
                    >
                        <v-btn
                            icon
                            dark
                            @click="dialog = false"
                            >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title v-if="editMode">Edit Imagen</v-toolbar-title>
                        <v-toolbar-title v-else>Create image</v-toolbar-title>

                    </v-toolbar>
                    <v-card-text>
                        <form-images :editMode="editMode" :showMode="showMode" :image="image" @save-image="saveImage" @update-image="updateImage" :imageable_type="imageable_type" :id="id"/>
                    </v-card-text>
                </v-card>
            </v-dialog>
            <v-progress-circular
                v-if="loading"
                :size="70"
                :width="7"
                color="purple"
                indeterminate
            ></v-progress-circular>
            <v-data-table
                v-if="!loading"
                :headers="headers"
                :items="images"
                :items-per-page="5"
                class="elevation-1"
            >
                <template v-slot:no-data>
                            No data
                </template>
                <template v-slot:[`item.actions`]="{ item }">
                    <v-btn
                        icon
                        >
                        <v-icon
                            class="mr-2"
                            color="warning"
                            @click="showImage(item)"
                        >
                            mdi-eye
                        </v-icon>
                    </v-btn>

                    <v-icon
                        icon
                        class="mr-2"
                        color="accent"
                        @click="editImage(item)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        color="error"
                        icon
                        @click="deleteImage(item)"
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-container>
    </div>
</template>
<script>
    export default {

        props: ['id', 'imageable_type'],

        data:() => ({
            loading: false,
            images: [],
            image: '',
            headers: [
                {
                    text: 'Title',
                    align: 'start',
                    value: 'title',
                },
                { text: 'Type', value: 'type' },
                { text: 'Description', value: 'description' },
                { text: 'Actions', value: 'actions' },
            ],
            dialog: false,
            editMode: false,
            showMode: false,
            imageEmpty: {
                title: '',
                description: '',
                path: '',
                multimedia_type: '',
                multimedia_id: '',
            },
        }),

        mounted(){
            this.initialize()
        },

        computed: {

            url(){
                if(this.imageable_type === 'Projects')
                    return 'projects'
            },
        },


        methods: {

            initialize(){
                let url = `/api/${this.url}/image/${this.id}`

                this.loading = true

                axios.get(url)
                .then((response => {
                    let images = response.data

                    if(images.length){
                        this.images = images
                    }else{
                        this.images = []
                    }

                    this.loading = false
                }))
            },

            addImage(){
                this.image = this.imageEmpty
                this.showMode = false
                this.editMode = false
                this.dialog = true
            },

            editImage(item){
                this.image = item
                this.showMode = false
                this.editMode = true
                this.showAnalytic = false
                this.dialog = true
            },

            showImage(item){
                /* console.log(item.id)
                window.location.href = `/administrator/show/${item.id}` */
            },

            saveImage(){
                this.showMode = false
                this.editMode = false
                this.initialize()
                this.image = this.imageEmpty
                this.dialog = false
            },

            updateImage(){
                this.showMode = false
                this.editMode = false
                this.initialize()
                this.image = this.imageEmpty
                this.dialog = false
            },

            deleteImage(item){
                let url = `/api/image/${item.id}`

                axios.delete(url)
                .then(response => {
                    
                    console.log('delete item');
                })
            },

        },

    }
</script>
<style scoped>
.v-progress-circular {
  margin: 1rem;
}
</style>
