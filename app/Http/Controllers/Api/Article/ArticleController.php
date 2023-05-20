<?php

namespace App\Http\Controllers\Api\Article;

use App\Utils\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Article\ArticleService;

class ArticleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct()
    {
        $this->articleService = new ArticleService;
        $this->helper = new Helper;
    }
    public function index(Request $request)
    {
        try {
            $article = $this->articleService->getSearch($request->query('keyword'), $request->query('category_slug'));
            if ($article->isEmpty()) {
                $data = $this->helper->response(404, 'Tidak ada data yang dapat ditampilkan');
                return response()->json($data, 404);
            }
            $data = $this->helper->response(200, 'Data berhasil didapatkan', $article);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            dd($th);
            $data = $this->helper->response(500, 'Kesalahan server');
            return response()->json($data, 500);
        }
    }
    public function show($slug)
    {
        try {
            $article = $this->articleService->getFirst($slug, 'slug');
            if (!$article) {
                $data = $this->helper->response(404, 'Tidak ada data yang dapat ditampilkan');
                return response()->json($data, 404);
            }
            $data = $this->helper->response(200, 'Data berhasil didapatkan', $article);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = $this->helper->response(500, 'Kesalahan server');
            return response()->json($data, 500);
        }
    }
}