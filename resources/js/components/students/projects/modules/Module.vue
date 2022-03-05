<template>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <!-- comprobar si no supera los intentos declarados en el proyecto-->
                <v-btn
                    :disabled="itIsAccesible"
                    @click="goToAQuiz()">
                    Take quiz
                </v-btn>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['module'],

        data:() => ({
            attempt: '',
            studentId: document.querySelector("meta[name='student']").getAttribute('content'),
        }),

        computed: {

            itIsAccesible(){
                if(!this.attempt) return false
                return this.module.attempt <= this.attempt
            }

        },

        mounted(){
            this.getAttempt()
            console.log(this.module)
        },

        methods: {

            getAttempt(){
                let url = `/api/attempts-by-student/${this.studentId}`
                
                const params = {
                    module_id:      this.module.id,
                }

                axios.get(url, {params})
                .then((response => {
                    this.attempt = response.data
                    console.log(this.module.attempt, ' <= ', this.attempt)
                    console.log(response.data)
                }))
            },

            goToAQuiz(){
                window.location.href = `/module/questions/${this.module.id}`
            },
        },
    }
</script>