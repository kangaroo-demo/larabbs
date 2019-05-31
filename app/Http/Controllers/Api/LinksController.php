<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use App\Transformers\LinkTransformer;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * 资源推荐
     * @param Link $link
     * @return \Dingo\Api\Http\Response
     */
    public function index(Link $link)
    {
        $link = $link->getAllCached();
        return $this->response->collection($link, new LinkTransformer());
    }
}
