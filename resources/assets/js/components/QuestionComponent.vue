<template>
    <div class="form-group">
        <label for="">{{ question.question }}</label>
        <select class="form-control" v-model="question.selection">
            <option v-for="answer in question.answers" :disabled="isDisabled(answer)" :selected="question.selection" v-bind:value="answer.id">{{ answer.answer }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        name: "question-component",
        props: [
            'question'
        ],
        methods: {

            isDisabled: function(answer){

                return answer.id == 0;
            }
        }
    }
</script>

<style scoped>

</style>