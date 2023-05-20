<?php

namespace App\Utils;

class Helper
{
   public function response($status_code, $status_message, $payload = null, $meta = null)
   {
      $response = [
         'status_code' => $status_code,
         'status_message' => $status_message,
      ];

      if ($payload) {
         $response['payload'] = $payload;
      }

      if ($meta) {
         $response['meta'] = $meta;
      }

      return $response;
   }
}