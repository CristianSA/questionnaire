<template>
    <div>
        <v-container data-app>
            <v-toolbar
                class="mb-4 primary"
                elevation="4"
            >
                <v-toolbar-title>{{ project.name }}</v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-progress-circular
                v-if="loading"
                :size="70"
                :width="7"
                color="purple"
                indeterminate
            ></v-progress-circular>
            <v-simple-table v-if="!loading">
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">Student Name</th>
                            <th class="text-left">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="student in students"
                            :key="student.id"
                            >
                            <td>{{student}}</td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-container>
    </div>
</template>
<script>
    export default {

        props: ['project'],

        data:() => ({
            loading: false,
            students: [],
            headers: [
                {
                    text: 'Student Name',
                    align: 'start',
                    value: 'name',
                },
                { text: 'E-mail', value: 'email' },
                { text: 'End', value: 'end' },
                { text: 'Status', value: 'status' },
                { text: 'Type', value: 'type' },
                { text: 'Actions', value: 'actions' },
            ],
        }),

        mounted(){
            this.getAnalytics()
        },

        methods: {

            getAnalytics(){
                let url = `/api/${this.project.id}/analytics`

                this.loading = true

                axios.get(url)
                .then((response => {
                    let students = response.data
                    console.log(students);
                    /* if(students.length){
                        this.students = students
                    }else{
                        this.students = []
                    } */

                    this.loading = false
                }))
            },
        },

    }
</script>
<style scoped>
.v-progress-circular {
  margin: 1rem;
}
</style>