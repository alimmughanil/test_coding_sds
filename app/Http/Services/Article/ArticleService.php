<?php

namespace App\Http\Services\Article;

use App\Models\Article;
use App\Http\Services\ServiceInterface;
use Illuminate\Support\Facades\Storage;

class ArticleService implements ServiceInterface
{
   public function getAll()
   {
      return Article::all();
   }
   public function getPaginate(int $number)
   {
      return Article::paginate($number)->get();
   }
   public function getFirst($value, $column = "id")
   {
      return Article::where($column, $value)->first();
   }
   public function create(array $request)
   {
      return Article::create($request);
   }
   public function update($id, array $request)
   {
      $existArticle = $this->getFirst($id);
      if (!$existArticle) return null;
      Storage::disk('public')->delete($existArticle->banner);
      return Article::where('id', $id)->update($request);
   }
   public function delete($id)
   {
      $existArticle = $this->getFirst($id);
      if (!$existArticle) return null;
      return Article::where('id', $id)->delete();
   }
}