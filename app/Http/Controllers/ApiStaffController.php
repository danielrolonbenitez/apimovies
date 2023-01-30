<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Staff;

class ApiStaffController extends ApiController
{

  public function index()
  {
    return $this->formatDate(Staff::all());
  }



  public function show($role = 'directors')
  {
    $staff = new Staff;
    $staff = ($role == 'directors') ? $staff->getAllDirectors() : $staff->getAllActors();
    return  $this->formatDate($staff);
  }
}
