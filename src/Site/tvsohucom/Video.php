<?php
namespace VideoParse\Site\tvsohucom;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取播放地址
     * @return array
     */
    public function getPlayUrl()
    {
        if (strpos($this->url, 'my.')) {
            $play_url = 'http://share.vrs.sohu.com/my/v.swf&topBar=1&id={id}&autoplay=false';
            preg_match("#(?<id>[0-9]+).sh#", $this->url, $m);
            if (!empty($m['id'])) {
                return ['swf' => str_replace('{id}', $m['id'], $play_url)];
            }
        } else {
            $play_url = 'http://share.vrs.sohu.com/{id}/v.swf&autoplay=false';
            $response = \Unirest\Request::get($this->url);
            preg_match('#vid="(?<id>.*?)"#', $response->body, $m);
            if (!empty($m['id'])) {
                return ['swf' => str_replace('{id}', $m['id'], $play_url)];
            }
        }

        return false;
    }
}