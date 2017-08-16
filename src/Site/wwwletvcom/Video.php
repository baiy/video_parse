<?php

namespace VideoParse\Site\wwwletvcom;

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
     * @return array
     */
    public function getPlayUrl()
    {
        $play_url = 'http://i7.imgs.letv.com/player/swfPlayer.swf?id={id}&autoplay=0';
        preg_match('#/(?<id>[0-9]+)\.html#', $this->url, $m);
        if (!empty($m['id'])) {
            return ['swf' => str_replace('{id}', $m['id'], $play_url)];
        }

        return false;
    }
}
