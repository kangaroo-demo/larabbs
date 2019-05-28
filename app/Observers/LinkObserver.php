<?php
/**
 * Created by PhpStorm.
 * User: kangaroo-demo
 * Date: 2019/5/28
 * Time: 16:51
 */

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    // 在保存时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}
