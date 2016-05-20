<?php
/**
 * 抓取56万视频
 */
namespace VideoParse\Site\vzolcomcn;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取下载地址
     * @param string $url 页面地址
     */
    public function GetDownloadUrl()
    {
        return false;
    }

    /**
     * 获取播放地址
     * @return array
     */
    public function GetPlayUrl()
    {
        $response = \Unirest\Request::get($this->url);
        preg_match('#value=\'(?<url>.*?)\'><a id="v_slink_souce"#', $response->body, $m);
        if (!empty($m['url'])) {
            return array('swf' => trim($m['url']));
        }
        return false;
    }
}
