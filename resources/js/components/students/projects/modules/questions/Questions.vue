<template>
    <div class="container">
        <v-stepper v-model="questionnarie">
            <v-stepper-header>
                <v-stepper-step 
                    v-for="(step,n) in questions"
                    :key="n"
                    :complete="stepComplete(n+1)"
                    :step="n+1"
                    :color="stepStatus(n+1)">
                    Question {{ n + 1 }} 
                </v-stepper-step>
            </v-stepper-header>
             <v-stepper-content v-for="(step,n) in questions" :step="n+1" :key="n">
                <p><strong>{{ step.question }}</strong></p>
                <v-radio-group v-model="radioGroup">
                    <v-radio
                        v-for="n in answers"
                        :key="n"
                        :label="`Radio ${n}`"
                        :value="n"
                    ></v-radio>
                </v-radio-group>
                <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
                <v-btn v-if="n+1 <= lastStep" color="primary" @click="answerQuestion(step.id), questionnarie = n+2, radioGroup = 1, questions_answered = n+1" :loading="loadButton">Continue</v-btn>
                <v-btn v-if="questionnarie > 1" text @click="questionnarie = n">Back</v-btn>
            </v-stepper-content>
            <v-row class="mx-3 py-2">
                <v-divider></v-divider>
                <v-btn @click="goToResults()">Results</v-btn>
            </v-row>
        </v-stepper>
    </div>
</template>
<script>
    export default {

        props: ['questions', 'module'],

        data:() => ({
            studentId: document.querySelector("meta[name='student']").getAttribute('content'),
            questionnarie: 1,
            questions_answered: 1,
            radioGroup: 1,
            lastStep: 0,
            loadButton: false,
            //send data
            answer: '',
            answers: ['A', 'B', 'C', 'D'],

        }),

        mounted(){
            this.lastQuestion()
            this.testing()
            console.log(this.questions)
        },

        methods: {
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

            lastQuestion(){
                this.lastStep = this.questions.length
            },

            stepComplete(step) {
                return this.questionnarie > step
            },

            stepStatus(step) {
                return this.questionnarie > step ? 'green' : 'blue'
            },

            done() {
                this.questionnarie = this.questions.length
            },

            answerQuestion(question_id){
                let url =  `/api/answer-question`

                const params = {
                    question_id:            question_id,
                    answer:                 this.radioGroup,
                    student_id:             this.studentId,
                }
                //console.log(params)
                this.loadButton = true

                axios.post(url, params)
                .then((response => {
                    let answer = response.data
                    console.log(answer)
                    
                    if(answer){

                        this.loadButton = false
                    }
                    
                    /* if(this.questions.length >= this.questions_answered){
                        this.done()
                        this.goToResults()
                    } */
                    
                }))
            },

            goToResults(){
                window.location.href = `/module/questions/results/${this.module.id}`
            },
        },
    }
</script>