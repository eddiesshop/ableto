<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Results:</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">
                                    Question
                                </th>
                                <th>
                                    Most Common Answer
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="question in questions">
                                <td>{{ question.question }}</td>
                                <td>{{ question.most_freq_answer.answer}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-md-8 col-md-offset-2">
                <button>Do It Again!</button>
            </div>
        </div>-->
    </div>
</template>

<script>
    export default {
        name: "results-component",
        data() {
            return {
                questions: []
            }
        },
        beforeCreate: function(){

            let vm = this;

            $.get({
                url: '/responses',
                data: {
                    group_by: 'question'
                }
            }).done(function(data){

                vm.questions = data;
            });
        }
    }
</script>

<style scoped>

</style>