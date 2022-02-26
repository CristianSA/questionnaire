<template>
    <div>
        <form class="py-4">
            <v-row>
                <v-col cols="6">
                    <v-text-field
                        label="Name"
                        outlined
                        v-model="name"
                        :counter="200"
                    ></v-text-field>
                </v-col>

                <v-col cols="6">
                    <v-text-field
                        label="Attempts"
                        outlined
                        v-model="attempt"
                        type="number"
                        :min="0"
                    ></v-text-field>
                </v-col>

            </v-row>

            <v-row>

                <v-col cols="6">
                    <v-select
                        label="Type"
                        outlined
                        v-model="type"
                        :items="allTypes"
                        @change="projectType()"
                    ></v-select>
                </v-col>

                <v-col cols="6" v-if="project_type === 'ONLY'">
                    <v-text-field
                        label="Password"
                        outlined
                        v-model="password_project"
                    ></v-text-field>
                </v-col>

                <v-col cols="6" v-if="project_type === 'MULTIPE'">
                    <v-select
                        label="Type"
                        outlined
                        v-model="type"
                        :items="allTypes"
                        @change="projectType()"
                    ></v-select>
                </v-col>

            </v-row>

            <v-row>

                <v-col cols="6">
                    <v-menu
                        ref="menu_start"
                        v-model="menu_start"
                        :close-on-content-click="false"
                        :return-value.sync="start"
                        transition="scale-transition"
                        offset-y
                        max-width="240px"
                        min-width="240px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                outlined
                                v-model="start"
                                label="Start date"
                                prepend-inner-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="start"
                            no-title
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menu_start = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menu_start.save(start)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>
                </v-col>

                <v-col cols="6">
                    <v-menu
                        ref="menu_end"
                        v-model="menu_end"
                        :close-on-content-click="false"
                        :return-value.sync="end"
                        transition="scale-transition"
                        offset-y
                        max-width="240px"
                        min-width="240px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                outlined
                                v-model="end"
                                label="End date"
                                prepend-inner-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="end"
                            no-title
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menu_end = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menu_end.save(end)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="3">
                    <v-sheet>
                        <v-switch
                            v-model="status"
                            inset
                            :label="`${statusText}`"
                        ></v-switch>
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row class="justify-end">
                <v-btn dark v-if="editMode" @click="updateProject()">Update</v-btn>
                <v-btn color="primary" dark @click="saveProject()" v-else>Save</v-btn>
            </v-row>
        </form>
    </div>
</template>
<script>
    export default {

        props: ['project','editMode'],

        data:() => ({
            name: "",
            start: "",
            menu_start: false,
            end: "",
            menu_end: false,
            type: "",
            allTypes: ['ONLY', 'MULTIPE'],
            attempt: "",
            status: false,
            project_type: "",
            password_project: "",
        }),

        watch: {
            project: {
                immediate: true,
                handler(newVal, oldVal){
                    if(this.editMode) this.displayInfo()
                }
            },
        },

        mounted(){
            
        },

        computed:{
            statusText(){
                return this.status ? 'Public' : 'Private'
            },
        },

        methods:{

            getParams(){
                return {
                    name:                   this.name,
                    start:                  this.start,
                    end:                    this.end,
                    type:                   this.type,
                    attempt:                this.attempt,
                    status:                 this.status,
                    password_project:       this.password_project,
                }
            },

            displayInfo(){
                this.name                   = this.project.name
                this.start                  = this.project.start
                this.end                    = this.project.end
                this.type                   = this.project.type
                this.attempt                = this.project.attempts
                this.status                 = this.project.status
                this.password_project       = this.project.password
            },
            
            saveProject(){
                let url = `/api/project`

                const params = this.getParams()

                axios.post(url, params)
                .then((response => {
                    let project = response.data
                    if(project){
                        this.$emit('save-project')
                        this.clear()
                    }
                }))
            },

            updateProject(){
                let url = `/api/project/${this.project.id}`

                const params = this.getParams()

                axios.put(url, params)
                .then((response => {
                    let project = response.data
                    if(project){
                        this.$emit('update-project')
                        this.clear()
                    }
                }))
            },

            clear(){
                this.name       = ''
                this.start      = ''
                this.end        = ''
                this.type       = ''
                this.attempt    = ''
                this.status     = ''
            },

            projectType(){
                this.project_type = this.type
            },

        },
        
    }
</script>