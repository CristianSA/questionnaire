<template>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <h4 class="display-3 text-white">My results</h4>
            </div>
        </div>

        <!--<project-list :projects="projects"></project-list> -->

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
                    Modules

                    <v-spacer></v-spacer>
                    <v-btn
                        icon
                        :loading="loadButton"
                        @click="getStudentProjectResults(project.id)"
                    >
                        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                    </v-btn>
                    </v-card-actions>
                    <v-expand-transition>
                    <div v-show="show">
                        <v-divider></v-divider>

                        <v-list-item v-if="student_results">
                            <v-list-item-content v-for="m in student_results.modules"
                                :key="m.id">
                                <v-list-item-title>{{m.name}}</v-list-item-title>
                                <hr>
                                <div v-for="(value, key, index) in student_results.answers">
                                    <div v-for="(a, key, index) in value">
                                        <span>Attempt {{key}}</span>
                                        <v-list-item-subtitle>{{ a.length }} / {{ m.number_of_questions }}</v-list-item-subtitle>
                                    </div>
                                </div>
                            </v-list-item-content>
                        </v-list-item>

                    </div>
                    </v-expand-transition>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
    export default {
        
        mounted(){
            this.getProjects()
            //this.testing()
            //this.getStudentProjectResults()
        },

        data:() => ({
            show: false,
            loadButton: false,
            studentId: document.querySelector("meta[name='student']").getAttribute('content'),
            projects: [],
            modules: [],
            student_results: [],
        }),
        
        methods: {

            testing(){
                let url = `/api/testing`

                const params = {
                    student_id:             this.studentId,
                }

                axios.get(url, {params})
                .then(response => {
                    console.log(response.data)
                })
            },

            getProjects(){
                let url = `/api/projects-by-student/${this.studentId}`

                axios.get(url)
                .then((response => {
                    let projects = response.data
                    //console.log(projects)
                    if(projects.length){
                        this.projects = projects
                    }else{
                        this.projects = []
                    }
                }))
            },

            getStudentProjectResults(project_id){
                this.show = !this.show

                let url = `/api/${this.studentId}/project-results`

                const params = {
                    project_id:                    project_id,
                }
                
                this.loadButton = true
                
                axios.get(url, {params})
                .then(response => {
                    this.student_results = response.data
                    console.log(response.data) 
                    this.loadButton = false
                })
            },

            getModules(project_id){
                this.show = !this.show
                
                let url = `/api/modules-by-project/${project_id}`

                const params = {
                    user_id:            this.studentId,
                }

                this.loadButton = true

                axios.get(url, params)
                .then(response => {
                    let modules = response.data

                    console.log(modules)

                    if(modules.length){
                        this.modules = modules
                    }else{
                        this.modules = []
                    }
                    this.loadButton = false
                })
            }
        }

    }
</script>