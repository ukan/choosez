<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\BulletinBoard;
use DB;

class BulletinController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {   
    	#-- Get Editor Data
        $data_editor = BulletinBoard::where('status','news')
                    ->where('publish_status', 'Yes')
                    ->orderBy('created_at', 'desc')
                    ->take(6)->get();

        $getDataEditor = [];
        foreach ($data_editor as $key => $value) {
            array_push($getDataEditor, $value);
        }

        #-- Get Articles
        $articles = BulletinBoard::where('status','article')
                    ->where('publish_status', 'Yes')
                    ->orderBy('created_at', 'desc')
                    ->take(5)->get();

        $counter=0;
        $getArticles = $getSingleArticle = [];
        foreach ($articles as $key => $article) {
            if($counter>0){
            	array_push($getArticles, $article);
            }else{
            	array_push($getSingleArticle, $article);
            }
        	$counter++;
        }

        #-- Get all new and article
        $allNews = BulletinBoard::where('publish_status', 'Yes')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $getAllNews = [];
        foreach ($allNews as $key => $news) {
            array_push($getAllNews, $news);
        }

        return view('frontend.bulletin.index')
       				->with('bulletin_news', $getDataEditor)
       				->with('all_news', $allNews)
       				->with('articles', $getArticles)
       				->with('singleArticle', $getSingleArticle);
    }
}