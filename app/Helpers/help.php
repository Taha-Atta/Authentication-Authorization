<?php

use Illuminate\Support\Facades\Auth;

function hasPermission($per)
{


    return Auth::guard('admin')->user()->hasAnyPermission($per) ? true : false;
}
