<?php
/**
 * 视频抓取样式
 */
namespace VideoParse\Site;

class Demo
{
    const SITE_LISTS = [
        'www56com' => [
            'name'            => '56网',
            'url'             => 'http://www.56.com/w87/play_album-aid-14296502_vid-MTQxMDAxODE3.html',
            'class_namespace' => 'www56com',
        ],
        'youku' => [
            'name'            => '优酷',
            'url'             => 'http://v.youku.com/v_show/id_XMTUzOTM5MjAxNg==.html',
            'class_namespace' => 'youku',
        ],
    ];

    public function start()
    {
        foreach (self::SITE_LISTS as $key => $value) {
            $this->run($key);
        }
    }

    public function run($site_key)
    {
        $site = self::SITE_LISTS[$site_key];

        $classname = '\\VideoParse\\Site\\' . $site['class_namespace'] . '\\video';
        $class     = new $classname();
        $class->SetUrl($site['url']);

        // 代码
        $code = '```php'."\n";
        $code.= '<?php'."\n";
        $code.= 'require_once \'./vendor/autoload.php\';'."\n";
        $code.= '$video = new '.$classname.'();'."\n";
        $code.= '$video->SetUrl(\''.$site['url'].'\');'."\n";
        $code.= 'print_r($video->GetPlayUrl());'."\n";
        $code.= 'print_r($video->GetDownloadUrl());'."\n";
        $code.= '?>'."\n";
        $code.= '```';

        echo "========= 开始测试 " . $site['name'] . " =========\n";
        echo "\n--- 代码 ---\n";
        echo $code."\n";
        echo "\n--- 播放地址 ---\n";
        print_r($class->GetPlayUrl());
        echo "\n--- 下载地址 ---\n";
        print_r($class->GetDownloadUrl());
        echo "\n======== 结束测试 " . $site['name'] . " =========\n\n\n\n\n";
    }
}
