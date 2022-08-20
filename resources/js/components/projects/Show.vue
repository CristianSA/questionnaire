<template>
    <div>
        <v-container data-app>

            <v-card >
                <v-row class="mx-5 mt-2">
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
            </v-card>

            <v-tabs center-active grow v-model="tabs" class="mt-5">
                <v-tab href="#tab-images">
                    Images
                </v-tab>
                <v-tab href="#tab-modules">
                    Modules
                </v-tab>
            </v-tabs>
            <v-tabs-items v-model="tabs">
                <v-tab-item value="tab-images">
                    <index-images :id="project.id" :imageable_type="'Projects'"/>
                </v-tab-item>
                <v-tab-item value="tab-modules">
                    test 2
                </v-tab-item>
            </v-tabs-items>
        </v-container>
    </div>
</template>
<script>
import { data } from 'browserslist';

    export default {
        props: ['project'],

        data: () => ({
            tabs: null,
        }),
    }
</script>
