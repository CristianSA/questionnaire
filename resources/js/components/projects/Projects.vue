<template>
    <div>
        <v-container data-app>
            <v-toolbar
                class="mb-2 transparent"
            >
                <v-toolbar-title>Projects</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn
                    depressed
                    dark
                    color="primary"
                    @click="addProject()"
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
                        <v-toolbar-title v-if="editMode">Edit Project</v-toolbar-title>
                        <v-toolbar-title v-else-if="showMode">Show Project</v-toolbar-title>
                        <v-toolbar-title v-else-if="showAnalytic">Show Analytics</v-toolbar-title>
                        <v-toolbar-title v-else>New Project</v-toolbar-title>

                    </v-toolbar>
                    <v-card-text>
                        <form-new-project v-if="!showMode && !showAnalytic" :editMode="editMode" :showMode="showMode" :project="project" @save-project="saveProject" @update-project="updateProject"></form-new-project>
                        <show-project v-if="showMode" :project="project"></show-project>
                        <show-analytic-project v-if="showAnalytic" :project="project"></show-analytic-project>
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
                :items="projects"
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
                            :href="route('admin show project', item)"
                        >
                            mdi-eye
                        </v-icon>
                    </v-btn>

                    <v-icon
                        icon
                        class="mr-2"
                        color="accent"
                        @click="editProject(item)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        v-if="item.is_delete"
                        color="error"
                        icon
                        @click="deleteProject(item)"
                    >
                        mdi-delete
                    </v-icon>
                    <v-icon
                        color="success"
                        @click="showAnalytics(item)"
                        icon>
                        mdi-google-analytics
                    </v-icon>
                </template>
            </v-data-table>
        </v-container>
    </div>
</template>
<script>
    export default {

        data:() => ({
            loading: false,
            projects: [],
            project: '',
            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    value: 'name',
                },
                { text: 'Start', value: 'start' },
                { text: 'End', value: 'end' },
                { text: 'Status', value: 'project_status' },
                { text: 'Type', value: 'type' },
                { text: 'Actions', value: 'actions' },
            ],
            dialog: false,
            editMode: false,
            showMode: false,
            showAnalytic: false,
            projectEmpty: {
                name: '',
                start: '',
                end: '',
                type: '',
                attempt: '',
                status: false,
                project_type: '',
                password_project: '',
                file: '',
            },
        }),

        mounted(){
            this.getProjects()
        },

        methods: {

            getProjects(){
                let url = `/api/projects`

                this.loading = true

                axios.get(url)
                .then((response => {
                    let projects = response.data

                    if(projects.length){
                        this.projects = projects
                    }else{
                        this.projects = []
                    }

                    this.loading = false
                }))
            },

            addProject(){
                this.project = this.projectEmpty
                this.showMode = false
                this.editMode = false
                this.showAnalytic = false
                this.dialog = true
            },

            editProject(item){
                this.project = item
                this.showMode = false
                this.editMode = true
                this.showAnalytic = false
                this.dialog = true
            },

            saveProject(){
                this.showMode = false
                this.editMode = false
                this.getProjects()
                this.project = this.projectEmpty
                this.dialog = false
            },

            updateProject(){
                this.showMode = false
                this.editMode = false
                this.getProjects()
                this.project = this.projectEmpty
                this.dialog = false
            },

            deleteProject(item){

            },

            showAnalytics(item){
                this.project = item
                this.showMode = false
                this.editMode = false
                this.showAnalytic = true
                this.dialog = true
            },
        },

    }
</script>
<style scoped>
.v-progress-circular {
  margin: 1rem;
}
</style>
