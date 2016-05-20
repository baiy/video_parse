## 描述
> 获取各大视频网站视频独立播放地址与下载地址

## 安装
### 使用 Composer 安装
```json
{
    "require-dev": {
        "baiy/VideoParse": "0.*"
    }
}
```
或者
```shell
composer require baiy/VideoParse
```

## 代码示例
```php
<?php
require_once 'vendor/autoload.php';
// 56
$video = new \VideoParse\Site\www56com\video();
$video->SetUrl('http://www.56.com/w87/play_album-aid-14296502_vid-MTQxMDAxODE3.html');
echo "\n--- 播放地址 ---\n";
print_r($video->GetPlayUrl());
echo "\n--- 下载地址 ---\n";
print_r($video->GetDownloadUrl());

// 优酷
$video = new \VideoParse\Site\youku\video();
$video->SetUrl('http://v.youku.com/v_show/id_XMTUzOTM5MjAxNg==.html');
echo "\n--- 播放地址 ---\n";
print_r($video->GetPlayUrl());
echo "\n--- 下载地址 ---\n";
print_r($video->GetDownloadUrl());
?>
```
> 更新代码实例请运行根目录下的 `demo.php`

## 支持网站
|网站|命名空间|下载地址|播放地址|
|---|---|---|----
|56|www56com|√|√|
|优酷|youku||√||
