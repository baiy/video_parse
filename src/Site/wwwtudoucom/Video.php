<?php
namespace VideoParse\Site\wwwtudoucom;


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
     * @return array
     */
    public function getPlayUrl()
    {
        $play_url = 'http://www.tudou.com/a/{lcode}/&iid={iid}&resourceId=0_04_05_99/v.swf';
        $response = \Unirest\Request::get($this->url);
        preg_match('#,lcode: \'(?<lcode>.*?)\'#', $response->body, $l);
        preg_match('#,iid: (?<iid>[0-9]+)#', $response->body, $i);
        if (!empty($l['lcode'])) {
            return ['swf' => str_replace(['{lcode}', '{iid}'], [$l['lcode'], $i['iid']], $play_url)];
        }

        return false;
    }
}