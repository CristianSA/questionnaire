<template>
    <div class="container">
        <v-row>
            <v-col cols="3"
                v-for="m in modules"
                :key="m.id">
                <v-card
                    class="mx-auto"
                    max-width="344"
                >
                    <v-card-text>
                    <div>{{ m.name }}</div>
                    <p class="text-h4 text--primary">
                        {{ m.start }}
                    </p>
                    <p></p>
                    <div class="text--primary">
                    </div>
                    </v-card-text>
                    <v-card-actions>
                    <v-btn
                        text
                        color="deep-purple accent-4"
                        @click="goToModule(m.id)"
                    >
                        Access
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
    export default {

        props: ['project'],

        data:() => ({
            modules: [],
            studentId: document.querySelector("meta[name='student']").getAttribute('content'),
        }),

        mounted(){
            console.log(this.project)
            this.getModules()
            /* this.testing() */
        },

        methods: {

            getModules(){
                let url = `/api/modules-by-project/${this.project.id}`
                /* console.log(url) */

                axios.get(url)
                .then((response => {
                    let modules = response.data
                    
                    if(modules.length){
                       /*  console.log(modules) */
                        this.modules = modules
                    }else{
                        this.modules = []
                    }
                }))
            },

            /* testing(){
                let url = `/api/testing`

                const params = {
                    student_id: this.studentId,
                }

                axios.get(url, {params})
                .then((response => {
                    let test = response.data
                    console.log(test)
                }))
            }, */

            goToModule(item){
                window.location.href = `/module/${item}`
            },
        },
    }
</script>