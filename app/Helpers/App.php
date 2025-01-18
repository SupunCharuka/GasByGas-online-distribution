<?php


use Illuminate\Support\Facades\Auth;

function authUserFolder(): string
{
    $folder = '';
    if (Auth::check()) {
        $roles = Auth::user()->getRoleNames()->toArray();
        if (in_array('user', $roles, true)) {
            $folder = 'user';
        } else {
            $folder = 'admin';
        }
    }
   
    return $folder;
}

