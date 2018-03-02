<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use App\Response;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function results()
    {
        return view('results');
    }

    /**
     * Get the list of questions and answers.
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Support\Collection an array of {@link \App\Question} objects
     */
    public function getQuestions(Request $request){

        return Question::with('answers')->get();
    }

    /**
     * Save the user's response to a question.
     *
     * @param \Illuminate\Http\Request;
     * @return JsonResponse
     */
    public function saveResponses(Request $request){

        $returnResponse = false;

        foreach($request->all() as $questionData) {

            $question = Question::findOrFail($questionData['id']);

            $answer = Answer::findOrFail($questionData['answer_id']);

            $response = new Response([
                'user_id' => $request->user()->id,
                'question_id' => $question->id,
                'answer_id' => $answer->id,
            ]);

            $returnResponse = $response->save();
        }

        return $returnResponse ? new JsonResponse(['ok']) : new JsonResponse('error', 422);
    }

    /**
     * Get a user's responses.
     *
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Support\Collection an array of {@link \App\Response} objects
     */
    public function getResponses(Request $request){

        $responses = Response::whereUserId($request->user()->id)->with([
            'question',
            'answer'
        ])->get();

        if($request->has('group_by')){

            switch ($request->group_by){

                case 'session':

                    return $responses->groupBy('session');

                default: //Group By Question

                    return $responses->groupBy('question_id')->transform(function($groupedQuestionResponse){

                        $question = $groupedQuestionResponse->first()->question;

                        $talliedAnswers = array_count_values($groupedQuestionResponse->pluck('answer_id')->toArray());

                        $indices = array_keys($talliedAnswers);

                        $mostFreqAnswer = head($talliedAnswers);

//                        dd($groupedQuestionResponse->where('answer.id', head($indices))->toArray());

                        $question->most_freq_answer = $groupedQuestionResponse->where('answer.id', head($indices))->first()->answer;

                        return $question;
                    });

                    return ;
            }
        }

        return $responses;
    }
}
