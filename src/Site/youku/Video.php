<?php

namespace VideoParse\Site\youku;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取下载地址
     *
     * @param string $url 页面地址
     */
    public function getDownloadUrl()
    {
        return false;
    }

    /**
     * 获取播放地址
     *
     * @param string $url 页面地址
     *
     * @return string 播放地址
     */
    public function getPlayUrl()
    {
        $play_url = 'http://player.youku.com/player.php/sid/{id}/v.swf';
        preg_match("#id_(?<id>.*?)\.html#", $this->url, $m);
        if (!empty($m['id'])) {
            return ['swf' => str_replace('{id}', $m['id'], $play_url)];
        }

        return false;
    }
}
