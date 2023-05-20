<?php

namespace App\Http\Services\Category;

use App\Models\Category;
use App\Http\Services\ServiceInterface;

class CategoryService implements ServiceInterface
{
   public function getAll()
   {
      return Category::all();
   }
   public function getPaginate(int $number)
   {
      return Category::paginate($number);
   }
   public function getFirst($value, $column = "id")
   {
      return Category::where($column, $value)->first();
   }
   public function create(array $request)
   {
      return Category::create($request);
   }
   public function update($id, array $request)
   {
      $existCategory = $this->getFirst($id);
      if (!$existCategory) return null;
      return Category::where('id', $id)->update($request);
   }
   public function delete($id)
   {
      $existCategory = $this->getFirst($id);
      if (!$existCategory) return null;
      return Category::where('id', $id)->delete();
   }
}