<?php

namespace App\Http\Controllers\Api\Category;

use App\Utils\Helper;
use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $categoryService = new CategoryService;
        $helper = new Helper;
        try {
            $categories = collect($categoryService->getPaginate(10));

            if ($categories->isEmpty()) {
                $data = $helper->response(404, 'Tidak ada data yang dapat ditampilkan');
                return response()->json($data, 404);
            }
            $data = $helper->response(200, 'Data berhasil didapatkan', $categories['data'], $categories['links']);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            $data = $helper->response(500, 'Kesalahan server');
            return response()->json(500, $data);
        }
    }
}