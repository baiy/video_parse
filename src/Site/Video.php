<?php
/**
 * 视频抓取基类
 */
namespace VideoParse\Site;

class Video
{
    public $url;
    /**
     * 设置页面地址
     * @param string $url 页面地址
     */
    public function SetUrl($url)
    {
        $jump_url = $this->CheckJump($url);
        $this->url = $jump_url ? $jump_url : $url;
    }

    /**
     * 获取下载地址
     * 默认采集flvcd数据
     * @param array
     */
    public function GetDownloadUrl(){
        $flvcd = new \VideoParse\Vendor\Flvcd();
        return $flvcd->parse($this->url);
    }

    /**
     * 获取播放地址
     * @return array
     */
    public function GetPlayUrl(){
        return false;
    }

    /**
     * 检查跳转
     * 获取跳转后的地址
     */
    protected function CheckJump($url){
        $header = get_headers($url,true);
        if (!empty($header['Location'])) {
            return $header['Location'];
        }
        return false;
    }
}