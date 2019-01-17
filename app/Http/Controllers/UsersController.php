<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * 初始化
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['expect' => ['show']]);
    }

    /**
     * 显示个人中心
     * @param User $user [in] 用户模型类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View [in] 渲染页面
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 显示编辑页面
     * @param User $user [in] 用户模型类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View [in] 渲染页面
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * 执行编辑操作
     * @param UserRequest $request [in] 用户表单验证
     * @param ImageUploadHandler $uploader [in] 图片上传类
     * @param User $user [in] 用户模型类
     * @return \Illuminate\Http\RedirectResponse [in] 页面跳转
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功');
    }
}
