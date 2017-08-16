<?php

namespace VideoParse\Site\vifengcom;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取播放地址
     *
     * @return array
     */
    public function getPlayUrl()
    {
        $play_url = 'http://v.ifeng.com/include/exterior.swf?guid={id}&AutoPlay=false';
        preg_match("#(?<id>[a-zA-Z0-9\-]{36})#", $this->url, $m);
        if (!empty($m['id'])) {
            return ['swf' => str_replace('{id}', $m['id'], $play_url)];
        }

        return false;
    }
}
