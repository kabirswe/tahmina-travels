<?php

use App\Models\UserActivity;
// use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use DB;

// function getCategories()
// {
//     $categories = Category::where('is_active', 1)->select('id', 'name')->get();
//     return $categories;
// }

// log_level ############
// general = 一般的な
// warning = 警告
// security = 保安
// login = ログインする
// logout = ログアウト
// create = 作成する
// update = 更新
// delete = 削除する

function createUserActivity($request, $action, $description, $log_level, $email)
{
    $userActivity = new UserActivity();
    $userActivity->action = $action;
    $userActivity->email = $email ?? auth()->user()->name . '<' . auth()->user()->email . '>';
    $userActivity->description = $description;
    $userActivity->log_level = $log_level;
    $userActivity->ip = $request->ip();
    $userActivity->browser = $request->header('User-Agent');
    $userActivity->save();
}

// last login helpers create
function lastLoginUser()
{
    $date = Auth::user()->last_login;
    $jplast_login = Carbon::parse($date)->format('Y/m/d H:i');
    return $jplast_login;
}

function isChecked($optionId, $itemArray = array())
{
    $checked = false;
    if (!empty($itemArray) && isset($optionId)) {
        if (in_array($optionId, $itemArray)) {
            $checked = true;
        }
    }
    return $checked;
}

/**
 * Unauthorized User
 */

function unauthorizedAccess($id)
{
    if (Auth::user()->id != $id) {
        return true;
    }
}
