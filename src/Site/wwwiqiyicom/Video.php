<?php
/**
 * 抓取56万视频
 */
namespace VideoParse\Site\wwwiqiyicom;

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
        $play_url = 'http://player.video.qiyi.com/{vid}/0/0/v_{uid}.swf-albumId=-tvId={id}-isPurchase=0-cnId=';
        $response = \Unirest\Request::get($this->url);
        preg_match('#data-player-videoid="(?<vid>.*?)"#', $response->body, $v);
        preg_match('#data-player-tvid="(?<id>.*?)"#', $response->body, $m);
        preg_match('#v_(?<uid>.*?)\.html#', $this->url, $u);
        if (!empty($m['id'])) {
            return array('swf' => str_replace(['{id}','{vid}','{uid}'], array($m['id'],$v['vid'],$u['uid']), $play_url));
        }
        return false;
    }
}