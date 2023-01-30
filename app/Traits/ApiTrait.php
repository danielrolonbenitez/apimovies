<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ApiTrait
{
  public function formatDate($data, $status = '')
  {
    try {
      if ($status) {
        $status = $status;
      } else {
        $status = app('Illuminate\Http\Response')->status();
      }

      if (!$data || !is_object($data)) {
        $status = 404;
        throw new NotFoundHttpException('Resource not found');
      }
    } catch (NotFoundHttpException $e) {
      $data = array("Errors" => $e->getMessage());
    }
    $result = array('status' => $status, 'content' => $data);
    return response()->json($result);
  }


  public function valiData($dato)
  {

    $data = json_decode($dato);
    if (json_last_error() === 0) {
      return $data;
    } else {
      return "format json is not valid";
    }
  }
}
