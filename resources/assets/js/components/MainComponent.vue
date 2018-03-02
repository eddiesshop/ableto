<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ greeting }}! Please answer the following list of questions:</div>

                    <div class="panel-body">
                        <form>
                            <div class="form-group" v-for="question in questions">
                                <question :question="question"></question>
                            </div>
                        </form>
                        <button @click="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                greeting: '',
                questions: []
            }
        },
        beforeCreate: function(){

            let vm = this;

            $.get({
                url: '/questions'
            }).done(function(data){

                vm.questions = data.map(function(question){

                    question.selection = 0;

                    question.answers.unshift({
                        id: 0,
                        answer: 'Select One...'
                    });

                    return question;
                });
            })
        },
        mounted() {

            let now = moment();
            let midnight = moment().startOf('day');
            let midday = moment().startOf('day').add(12, 'h');
            let evening = moment().endOf('day').subtract(6, 'h');

            if(now.isBetween(midnight, midday)){

                this.greeting = 'Good Morning';
            }

            if(now.isBetween(midday, evening)){

                this.greeting = 'Good Afternoon';
            }

            if(now.isAfter(evening)){

                this.greeting = 'Good Evening';
            }

            console.log('Main Component Mounted');

        },
        methods: {
            submit: function(){

                let vm = this;

                let data = [];

                vm.questions.forEach(function(question){

                    let postQuestion = {
                        id: question.id,
                        answer_id: question.selection
                    };

                    data.push(postQuestion);
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/responses',
                    method: "POST",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(data)
                }).done(function(data){

                    console.log('Posted Successfully', data);
                })

            }
        },
        components: {
            question: require('./QuestionComponent.vue')
        }
    }
</script>

<style scoped>

</style>