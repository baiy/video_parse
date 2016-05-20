<?php
/**
 * 抓取56万视频
 */
namespace VideoParse\Site\v17173com;

class Video extends \VideoParse\Site\Video
{
    /**
     * 获取播放地址
     * @return array
     */
    public function getPlayUrl()
    {
        $play_url = 'http://f.v.17173cdn.com/player_f2/{id}.swf';
        preg_match('#com/.*?/(?<id>.*?)\.html#', $this->url, $m);
        if (!empty($m['id'])) {
            return ['swf' => str_replace('{id}', $m['id'], $play_url)];
        }

        return false;
    }
}