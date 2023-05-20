<?php

namespace App\Http\Controllers\Api\Article;

use App\Utils\Helper;
use App\Http\Controllers\Controller;
use App\Http\Services\Article\ArticleService;

class ArticleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function show($slug)
    {
        $articleService = new ArticleService;
        $helper = new Helper;
        try {
            $article = $articleService->getFirst($slug, 'slug');
            if (!$article) {
                $data = $helper->response(404, 'Tidak ada data yang dapat ditampilkan');
                return response()->json($data, 404);
            }
            $data = $helper->response(200, 'Data berhasil didapatkan', $article);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = $helper->response(500, 'Kesalahan server');
            return response()->json($data, 500);
        }
    }
}