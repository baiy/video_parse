<?php
/**
 * 抓取56万视频
 */
namespace VideoParse\Site\www56com;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取播放地址
     * @return array
     */
    public function GetPlayUrl()
    {
        $play_url = 'http://share.vrs.sohu.com/my/v.swf&topBar=1&id={id}&autoplay=false&from=page';
        $response = \Unirest\Request::get($this->url);
        preg_match("#vid: '(?<id>.*?)',#", $response->body, $m);
        if (!empty($m['id'])) {
            return array('swf' => str_replace('{id}', $m['id'], $play_url));
        }
        return false;
    }
}
