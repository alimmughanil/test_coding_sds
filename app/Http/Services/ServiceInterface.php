<?php

namespace App\Http\Services;

interface ServiceInterface
{
   public function getAll();
   public function getPaginate(int $number);
   public function getFirst($value, $column);
   public function create(array $request);
   public function update($id, array $request);
   public function delete($id);
}