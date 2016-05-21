<?php
namespace VideoParse\Site\wwwaipaicom;


class Video extends \VideoParse\Site\Video
{
    /**
     * 获取播放地址
     * @return array
     */
    public function getPlayUrl()
    {
        $play_url = 'http://www.aipai.com/{cid}/{id}/playerOut.swf';
        preg_match('#com/(?<cid>.*?)/(?<id>.*?)\.html#', $this->url, $m);
        if (!empty($m['id'])) {
            return ['swf' => str_replace(['{id}', '{cid}'], [$m['id'], $m['cid']], $play_url)];
        }

        return false;
    }
}