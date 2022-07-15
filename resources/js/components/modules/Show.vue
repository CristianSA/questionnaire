<template>
    <div>
        <v-row class="mx-5">
            <v-col cols="3">
                <p><strong>Name</strong></p>
                <p>{{ project.name }}</p>
            </v-col>

            <v-col cols="3">
                <p><strong>Start</strong></p>
                <p>{{ project.start }}</p>
            </v-col>

            <v-col cols="3">
                <p><strong>End</strong></p>
                <p>{{ project.end }}</p>
            </v-col>

            <v-col cols="3">
                <p><strong>Attempts</strong></p>
                <p>{{ project.attempts }}</p>
            </v-col>

            <v-col cols="3">
                <p><strong>Type</strong></p>
                <p>{{ project.type }}</p>
            </v-col>

            <v-col cols="3">
                <p><strong>Status</strong></p>
                <p>{{ project.status }}</p>
            </v-col>


        </v-row>
    </div>
</template>
<script>
    export default {
        props: ['project']
    }
</script>