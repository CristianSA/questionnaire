<template>
    <div>
        <v-container data-app>

            <v-card >
                <v-toolbar
                    class="mb-2 elevation-0"
                >
                    <v-toolbar-title>General information</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="purple"
                        icon>
                        <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                </v-toolbar>

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
                        <p>{{ project.project_status }}</p>
                    </v-col>

                </v-row>
            </v-card>

            <v-tabs center-active grow v-model="tabs" class="mt-5">
                <v-tab href="#tab-passwords" v-if="isMultiple">
                    Passwords
                </v-tab>
                <v-tab href="#tab-images">
                    Images
                </v-tab>
                <v-tab href="#tab-modules">
                    Modules
                </v-tab>
            </v-tabs>
            <v-tabs-items v-model="tabs">
                <v-tab-item value="tab-passwords" v-if="isMultiple">
                    test 2
                </v-tab-item>
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

        computed:{

            isMultiple(){
                return this.project.type === 'MULTIPLE' ? true : false
            },

        },
    }
</script>
