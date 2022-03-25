<template>
    <div>
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
                    
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
    export default {

        props: ['projects'],
    }
</script>