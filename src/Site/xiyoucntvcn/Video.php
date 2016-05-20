<?php
/**
 * 抓取56万视频
 */
namespace VideoParse\Site\xiyoucntvcn;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取播放地址
     * @return array
     */
    public function GetPlayUrl()
    {
        $play_url = 'http://player.xiyou.cntv.cn/{id}.swf';
        preg_match("#v-(?<id>[a-zA-Z0-9\-]{36})#", $this->url, $m);
        if (!empty($m['id'])) {
            return array('swf' => str_replace('{id}', $m['id'], $play_url));
        }
        return false;
    }
}
