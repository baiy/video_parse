<?php
/**
 * 视频抓取基类.
 */

namespace VideoParse\Site;

class Video
{
    public $url;

    /**
     * 设置页面地址
     *
     * @param string $url 页面地址
     */
    public function setUrl($url)
    {
        $jump_url = $this->checkJump($url);
        $this->url = $jump_url ? $jump_url : $url;
    }

    /**
     * 检查跳转
     * 获取跳转后的地址
     */
    protected function checkJump($url)
    {
        $header = get_headers($url, true);
        if (!empty($header['Location'])) {
            return $header['Location'];
        }

        return false;
    }

    /**
     * 获取下载地址
     * 默认采集flvcd数据.
     *
     * @param array
     */
    public function getDownloadUrl()
    {
        $flvcd = new \VideoParse\Vendor\Flvcd();

        return $flvcd->parse($this->url);
    }

    /**
     * 获取播放地址
     *
     * @return array
     */
    public function getPlayUrl()
    {
        return false;
    }
}
