<?php
/**
 * 视频抓取演示
 */
namespace VideoParse\Site;

class Demo
{
    const SITE_LISTS = [
        'www56com'    => [
            'name'            => '56网',
            'url'             => ['http://www.56.com/w87/play_album-aid-14296502_vid-MTQxMDAxODE3.html'],
            'class_namespace' => 'www56com',
        ],
        'youku'       => [
            'name'            => '优酷',
            'url'             => ['http://v.youku.com/v_show/id_XMTUzOTM5MjAxNg==.html'],
            'class_namespace' => 'youku',
        ],
        'xiyoucntvcn' => [
            'name'            => '爱西柚',
            'url'             => ['http://xiyou.cntv.cn/v-b5857158-1e39-11e6-b0fa-ecf4bbe6c24c.html'],
            'class_namespace' => 'xiyoucntvcn',
        ],
        'vifengcom'   => [
            'name'            => '凤凰视频',
            'url'             => ['http://v.ifeng.com/mil/mainland/201605/01db520a-94be-4257-818a-322ecb6420bb.shtml'],
            'class_namespace' => 'vifengcom',
        ],
        'tvsohucom'   => [
            'name'            => '搜狐视频',
            'url'             => [
                'http://my.tv.sohu.com/pl/9069658/83879705.shtml',
                'http://tv.sohu.com/20160518/n450053769.shtml'
            ],
            'class_namespace' => 'tvsohucom',
        ],
        'vzolcomcn'   => [
            'name'            => 'ZOL视频',
            'url'             => ['http://zol.iqiyi.com.cn/video183889.html', 'http://v.zol.com.cn/video109402.html'],
            'class_namespace' => 'vzolcomcn',
        ],
        'v17173com'   => [
            'name'            => '17173视频',
            'url'             => [
                'http://v.17173.com/v_102_604/MzQxMTU2OTg.html',
                'http://17173.tv.sohu.com/v_102_604/MTE2ODAwNDA.html'
            ],
            'class_namespace' => 'v17173com',
        ],
        'wwwiqiyicom' => [
            'name'            => '爱奇艺',
            'url'             => ['http://www.iqiyi.com/v_19rro31oes.html', 'http://www.iqiyi.com/v_19rrifwg66.html'],
            'class_namespace' => 'wwwiqiyicom',
        ],
        'wwwaipaicom' => [
            'name'            => '爱拍原创',
            'url'             => [
                'http://www.aipai.com/c32/PTgoKSsqISdqJWQhLg.html',
                'http://www.aipai.com/c31/PTgnJyomICJqJWQtKA.html'
            ],
            'class_namespace' => 'wwwaipaicom',
        ],
        'wwwletvcom'  => [
            'name'            => '乐视',
            'url'             => [
                'http://www.le.com/ptv/vplay/623108.html',
                'http://www.le.com/ptv/vplay/25469527.html'
            ],
            'class_namespace' => 'wwwletvcom',
        ],
        'wwwtudoucom' => [
            'name'            => '土豆',
            'url'             => [
                'http://www.tudou.com/albumplay/HwVNXEUHedQ.html',
                'http://www.tudou.com/albumplay/X6o-z0aK9sk/-Ffvobj-HwE.html'
            ],
            'class_namespace' => 'wwwtudoucom',
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
        $no   = 1;
        foreach ($site['url'] as $value) {
            $this->execute($value, $site['name'], $site['class_namespace'], $no++);
        }
    }

    private function execute($url, $name, $class_namespace, $no)
    {
        $classname = '\\VideoParse\\Site\\' . $class_namespace . '\\video';
        $class     = new $classname();
        $class->setUrl($url);

        // 代码
        $code = '```php' . "\n";
        $code .= '<?php' . "\n";
        $code .= 'require_once \'./vendor/autoload.php\';' . "\n";
        $code .= '$video = new ' . $classname . '();' . "\n";
        $code .= '$video->setUrl(\'' . $url . '\');' . "\n";
        $code .= 'print_r($video->getPlayUrl());' . "\n";
        $code .= 'print_r($video->getDownloadUrl());' . "\n";
        $code .= '?>' . "\n";
        $code .= '```';

        echo "========= 开始测试 " . $name . ($no != 1 ? $no : '') . " =========\n";
        echo "\n--- 代码 ---\n";
        echo $code . "\n";

        $r = $class->getPlayUrl();
        echo "\n--- 播放地址 ---\n";
        print_r($r);

        $r = $class->getDownloadUrl();
        if ($r === false) {
            echo "\n--- 暂时无法获取下载地址 ---\n";
        } else {
            echo "\n--- 下载地址 ---\n";
            print_r($r);
        }
        echo "\n======== 结束测试 " . $name . ($no != 1 ? $no : '') . " =========\n\n\n\n\n";
    }
}
