<?php

namespace think\console\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\App;

class Version extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('version')
            ->setDescription('show ectouch framework version');
    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln(VERSION);
    }

}
