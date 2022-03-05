<template>
    <div class="container">
        <v-row>
            <v-col cols="3"
                v-for="project in projects"
                :key="project.id">
                <v-card
                    class="mx-auto"
                    max-width="344"
                >
                    <v-card-text>
                    <div>{{ project.name }}</div>
                    <p class="text-h4 text--primary">
                        {{ project.start }}
                    </p>
                    <p></p>
                    <div class="text--primary">
                    </div>
                    </v-card-text>
                    <v-card-actions>
                    <v-btn
                        text
                        color="deep-purple accent-4"
                        @click="goToProject(project.id)"
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

        data:() => ({
            projects: [],
            studentId: document.querySelector("meta[name='student']").getAttribute('content'),
        }),

        mounted(){
            this.getProjects()
            this.testing()
        },

        methods: {

            getProjects(){
                let url = `/api/projects-by-student/${this.studentId}`
                /* console.log(url) */

                axios.get(url)
                .then((response => {
                    let projects = response.data
                    
                    if(projects.length){
                       /*  console.log(projects) */
                        this.projects = projects
                    }else{
                        this.projects = []
                    }
                }))
            },

            testing(){
                let url = `/api/testing`

                const params = {
                    student_id: this.studentId,
                }

                axios.get(url, {params})
                .then((response => {
                    let test = response.data
                    console.log(test)
                }))
            },

            goToProject(item){
                window.location.href = `/modules/${item}`
                console.log(item)
            },
        },
    }
</script>