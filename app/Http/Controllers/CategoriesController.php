<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * 分类详情
     * @param Category $category [in] 分类模型
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View [in] 渲染视图
     */
    public function show(Category $category, Request $request, Topic $topic, User $user)
    {
        // 读取分类下的话题，并按每 20 条分页
        $topics = $topic->WithOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(20);

        $active_users = $user->getActiveUsers();

        return view('topics.index', compact('topics', 'category', 'active_users'));
    }
}
