<?php
/**
 * 抓取56万视频
 */
namespace VideoParse\Site\youku;

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
     * @param string $url 页面地址
     * @return string 播放地址
     */
    public function GetPlayUrl()
    {
        $play_url = 'http://player.youku.com/player.php/sid/{id}/v.swf';
        preg_match("#id_(?<id>.*?)\.html#", $this->url, $m);
        if (!empty($m['id'])) {
            return array('swf' => str_replace('{id}', $m['id'], $play_url));
        }
        return false;
    }
}
