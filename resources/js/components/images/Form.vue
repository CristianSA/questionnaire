<template>
    <div>
        <form class="py-4" @submit="saveImage" enctype="multipart/form-data">
            <v-row>
                <v-col cols="3">
                    <v-text-field
                        dense
                        outlined
                        v-model="title"
                        label="Title">
                    </v-text-field>
                </v-col>

                <v-col cols="3">
                    <v-text-field
                        dense
                        outlined
                        v-model="description"
                        label="Description">
                    </v-text-field>
                </v-col>

                <v-col cols="3">
                    <v-select
                        dense
                        outlined
                        v-model="type"
                        label="Type"
                        :items="types">
                    </v-select>
                </v-col>

                <v-col cols="3">
                    <v-file-input
                        dense
                        outlined
                        show-size
                        counter
                        multiple
                        label="Image file"
                        v-on:change="onImageChange"
                    ></v-file-input>
                </v-col>

                <v-col cols="3">
                    <img :src="src" id="image-preview"/>
                </v-col>
            </v-row>

            <v-row class="justify-end">
                <v-btn dark v-if="editMode" @click="updateImage()">Update</v-btn>
                <v-btn dark v-else color="primary" @click="saveImage()">Save</v-btn>
            </v-row>
        </form>
    </div>
</template>
<script>
    export default {

        props: ['image','editMode', 'imageable_type', 'id'],

        data:() => ({
            title: "",
            description: "",
            type: "",
            types: ["BANNER", "PROJECT", "MODULE", "QUESTION"],
            file: '',
            src: '',
        }),

        watch: {
            image: {
                immediate: true,
                handler(newVal, oldVal){
                    if(this.editMode){
                        this.displayInfo()
                    }else{
                        this.clear()
                    }


                }
            },
        },

        mounted(){
        },

        computed:{
        },

        methods:{

            onImageChange(e){
                this.file = e[0];
                this.loadPicture(this.file)
            },

            getParams(){
                return {
                    title:                      this.title,
                    description:                this.description,
                    type:                       this.type,
                    imageable_type:             this.imageable_type,
                    imageable_id:               this.id,
                }
            },

            displayInfo(){
                this.title                      = this.image.title
                this.description                = this.image.description
                this.type                       = this.image.type
                
            },

            saveImage(){

                let url = `/api/image`

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData()

                data.append('file', this.file)
                data.append('title', this.title)
                data.append('description', this.description)
                data.append('type', this.type)
                data.append('imageable_type', this.imageable_type)
                data.append('imageable_id', this.id)

                axios.post(url, data, config)
                .then((response => {
                    let image = response.data

                    if(image){
                        this.$emit('save-image')
                        this.clear()
                    }
                }))
            },

            updateImage(){
                let url = `/api/image/${this.image.id}`

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData()

                data.append('file', this.file)
                data.append('title', this.title)
                data.append('description', this.description)
                data.append('type', this.type)
                data.append('imageable_type', this.imageable_type)
                data.append('imageable_id', this.id)

                axios.put(url, data, config)
                .then((response => {
                    let image = response.data
                    if(image){
                        this.$emit('update-image')
                        this.clear()
                    }
                }))
            },

            clear(){
                this.title                      = ''
                this.description                = ''
                this.type                       = ''
                this.file                       = ''
                this.src                        = ''
            },

            loadPicture(file){

                let self = this
                let image_preview = document.getElementById('image-preview')
                var reader = new FileReader()
                reader.onload = function(e){
                    self.src = e.target.result
                }
                reader.readAsDataURL(file)
            },

        },

    }
</script>
