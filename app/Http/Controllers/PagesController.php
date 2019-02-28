<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request,User $user, Link $link)
    {
        $topics = Topic::withOrder($request->order)->paginate(20);

        $active_users = $user->getActiveUsers();

        $links = $link->getAllCached();

        return view('topics.index', compact('topics','active_users','links'));
    }

    public function permissionDenied()
    {
        // 如果当前用户有权限访问后台，直接跳转访问
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }
        // 否则使用视图
        return view('pages.permission_denied');
    }
}
