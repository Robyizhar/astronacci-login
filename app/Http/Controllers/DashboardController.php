<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $user = $request->user();

        switch ($user->type) {
            case $user->type == 'A':
                $limit = 3;
            break;

            case $user->type == 'B':
                $limit = 10;
            break;

            default:
                $limit = PHP_INT_MAX;
            break;
        }

        $articles = Article::with('video')->limit($limit)->get();
        // return response()->json([
        //     'type' => $user->type,
        //     'articles' => $articles,
        // ], 200);
        return view('dashboard', [
            'user' => $user,
            'articles' => $articles,
            'limit' => $limit
        ]);
    }
}
