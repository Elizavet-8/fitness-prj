<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    function index(Request $request, $id)
    {
        $searchFlag = false;
        if($id==null)
            return redirect()->route('question');
        $question = Question::find($id);
        if($question!=NULL)
            return view('article')->with('question', $question);
        return redirect()->route('question',compact('searchFlag'));
    }

    function searchQuestions(Request $request){
        $searchFlag = true;
        $search_text = '%'.$request->question.'%';
        $questions = [];
        if($search_text){
            $questions = Question::where('name','like',$search_text)
                                 ->orWhere('answer','like',$search_text)
                                 ->get();
        }
        return response()->json($questions);
    }

    function search(Request $request){
        $searchFlag = true;
        $questions = $request->questions;
        return view('search')->with(compact('questions'));
    }

    function adminArticle(Request $request, $id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $article = Question::find($id);
        return view('admin.dashboard.question.questionShow')->with('article', $article);
    }

    function adminShowArticle(Request $request, $id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $article = Question::find($id);
        $topic = Topic::find($article->topic_id);
        $topics = Topic::where('id','!=',$article->topic_id)->get();
        return view('admin.dashboard.question.questionEditForm')->with(compact('article','topic','topics'));
    }

    function adminEditArticle(Request $request, $id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $topic_id = $request->topic_id;
        $name = $request->name;
        $answer = $request->answer;

        if($id!=null && $topic_id!=null && $name!=null && $answer!=null){
            /*$topic_id = Topic::where('name','=',$topic)->first()->id;
            if($topic_id==null){
                $new_topic = new Topic();
                $new_topic->name = $topic;
                $new_topic->save();
                $topic_id = Topic::where('name','=',$topic)->first()->id;
            }*/
            //dd($topic_id,$name,$answer);
            Question::whereId($id)->update([
                'topic_id' => $topic_id,
                'name' => $name,
                'answer' => $answer
            ]);
        }
        return redirect()->route('adminQuestion');
    }

    function adminAddView(Request $request){
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $topics = Topic::all();
        return view('admin.dashboard.question.questionAddForm')->with(compact('topics'));
    }

    function adminAddArticle(Request $request)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $topic_id = $request->topic_id;
        $name = $request->name;
        $answer = $request->answer;

        if($topic_id!=null && $name!=null && $answer!=null){
            //dd($topic_id,$name,$answer);
            Question::create([
                'topic_id' => $topic_id,
                'name' => $name,
                'answer' => $answer
            ]);
        }
        return redirect()->route('adminQuestion');
    }

    function adminArticles(Request $request){
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        $articles = Question::with('topic')->get();
        $topics = Topic::all();
        return view('admin.dashboard.question.questionList')->with(compact('articles','topics'));
    }

    function adminDeleteArticle(Request $request, $id)
    {
        if(is_null(Auth::guard('admin')->user()))
            abort(401);
        Question::where('id','=',$id)->delete();
        return redirect()->route('adminQuestion');
    }
}
