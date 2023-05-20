<?php

namespace App\Http\Services\Auth;

use App\Models\User;
use App\Http\Services\ServiceInterface;

class UserService implements ServiceInterface
{
   public function getAll()
   {
      return User::all();
   }
   public function getPaginate(int $number)
   {
      return User::paginate($number)->get();
   }
   public function getFirst($column = 'id', $value)
   {
      return User::where($column, $value)->first();
   }
   public function create(array $request)
   {
      return User::create($request);
   }
   public function update($id, array $request)
   {
      $existUser = $this->getById($id);
      if (!$existUser) return null;
      return User::where('id', $id)->update($request);
   }
   public function delete($id)
   {
      $existUser = $this->getById($id);
      if (!$existUser) return null;
      return User::where('id', $id)->delete();
   }
}