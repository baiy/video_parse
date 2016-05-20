<?php
/**
 * 视频抓取接口
 */
namespace VideoParse\Vendor;

class Flvcd
{
    /**
     * 解析下载地址
     *
     * @param  string $url 页面地址
     *
     * @return array
     */
    public function parse($url)
    {
        $flvcd_url = 'http://www.flvcd.com/parse.php?kw=' . urlencode($url);
        $response  = \Unirest\Request::get($flvcd_url);
        $html      = iconv('GB2312', 'UTF-8//IGNORE', $response->body);

        // 下载地址
        preg_match_all('#href="(?<url>.*?)".*?onclick=\'_alert\(\);return false;\'#', $html, $m);
        $down_list = [];
        if (!empty($m['url'])) {
            foreach ($m['url'] as $key => $value) {
                $down_list[] = trim($value);
            }
        }

        // 名称
        preg_match('#document.title = "(?<title>.*?)" \+#', $html, $m);
        $title = empty($m['title']) ? '' : trim($m['title']);

        if (empty($down_list) || empty($title)) {
            return [];
        }

        return [
            'title'     => $title,
            'down_list' => $down_list,
        ];
    }

}
