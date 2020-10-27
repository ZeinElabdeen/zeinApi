<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionsCollection;
use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index () {
        $this->validate(request(),[
            'category' => 'exists:categories,id',
            'type' => 'in:1,2',
            'count' => 'integer',
        ]);
        $questions = Question::where('category_id',request()->category)
            ->where('type',request()->type)
            ->inRandomOrder()->take(request()->count)->get();
//        return $questions;
        return response()->json(['data' => ['online_questions' => new QuestionsCollection($questions)]]);
    }
}
