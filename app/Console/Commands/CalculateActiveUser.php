<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CalculateActiveUser extends Command
{
    /**
     * 供我们调用命令
     * @var string
     */
    protected $signature = 'larabbs:calculate-active-user';

    /**
     * 命令的描述
     * @var string
     */
    protected $description = '生成活跃用户';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 最终执行的方法
     * @return mixed
     */
    public function handle(User $user)
    {
        // 在命令行打印一行信息
        $this->info("开始计算");

        $user->calculateAndCacheActiveUsers();

        $this->info("成功生成！");
    }
}
