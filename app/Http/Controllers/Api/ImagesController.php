<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Transformers\ImageTransformer;
use App\Http\Requests\Api\ImageRequest;

class ImagesController extends Controller
{
    /**
     * 图片上传
     * @param ImageRequest $request [in opt] 请求类
     * @param ImageUploadHandler $handler [in opt] 图片上传类
     * @param Image $image [in opt] 图片模型
     */
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image)
    {
        // 获取当前登录用户
        $user = $this->user();

        // 根据图片类型设定图片大小
        $size = $request->type == 'avatar' ? 360 : 1024;

        // 上传图片
        $result = $uploader->save($request->image, str_plural($request->type), $user->id, $size);

        // 保存图片资源到数据库
        $image->path = $result['path'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();

        return $this->response->item($image, new ImageTransformer())->setStatusCode(201);
    }
}
