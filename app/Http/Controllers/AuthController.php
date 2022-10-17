<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me(){
        return [
            'NIS' => 3103120126,
            'Name' => 'Laila Fiqy',
            'Phone' => '081226969099',
            'Class' => 'XII RPL 4'
        ];
    }
}


