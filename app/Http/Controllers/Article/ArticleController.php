<?php

namespace App\Http\Controllers\Article;

use Inertia\Inertia;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Services\Article\ArticleService;
use App\Http\Services\Category\CategoryService;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->articleService = new ArticleService();
        $this->categoryService = new CategoryService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = $this->articleService->getAll();
        return Inertia::render('Article/Index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return Inertia::render('Article/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string',
            'slug' => 'required|string|unique:' . Article::class,
            'content' => 'required|string',
            'banner' => 'required|file|image',
        ]);
        if ($request->banner) {
            $fileName = $request->banner->getClientOriginalName() . substr(now()->valueOf(), 0, 10);
            $storeFile = Storage::disk('public')->putFileAs('banner', $request->banner, $fileName);
            if (!$storeFile) return redirect()->back();

            $validatedData['banner'] = $storeFile;
        }
        $store = $this->articleService->create($validatedData);
        if (!$store) return redirect()->back();
        return redirect('/article');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = $this->articleService->getFirst($slug, 'slug');
        return Inertia::render('Article/Show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = $this->articleService->getFirst($id);
        $categories = $this->categoryService->getAll();
        return Inertia::render('Article/Edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|string',
            'slug' => 'required|string|unique:' . Article::class . ',id,' . $id,
            'content' => 'required|string',
            'banner' => 'required|file|image',
        ]);
        if ($request->banner) {
            $fileName = substr(now()->valueOf(), 0, 10) . '-' . $request->banner->getClientOriginalName();
            $storeFile = Storage::disk('public')->putFileAs('banner', $request->banner, $fileName);
            if (!$storeFile) return redirect()->back();

            $validatedData['banner'] = $storeFile;
        }
        $update = $this->articleService->update($id, $validatedData);
        if (!$update) return redirect()->back();
        return Inertia::location('/article');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->articleService->delete($id);
        if (!$delete) return redirect()->back();
        return Inertia::location('/article');
    }
}