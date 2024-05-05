<?php
declare (strict_types = 1);

namespace app\admin\service\define;
use jianyan\excel\Excel;

class BookmarksService
{
    /**
     * @param (string)$htmlContent 书签内的内容
     * @param (bool)$isExportExcel 是否导出成 Excel
     * @return array
     */
    public function ParseBookmarks($htmlContent, $isExportExcel = false , $isDescription = false) {
        $result = array();

        $pattern = '/<DT><H3 ADD_DATE="\d+" LAST_MODIFIED="\d+">([^<]+)<\/H3>\s*<DL><p>(.*?)<\/DL>/s';
        preg_match_all($pattern, $htmlContent, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $category = $match[1];
            $categoryContent = $match[2];

            $categoryData = array(
                'category' => $category,
                'links' => array()
            );

            $patternLinks = '/<DT><A HREF="([^"]+)" ADD_DATE="\d+" ICON="([^"]+)">([^<]+)<\/A>/';
            preg_match_all($patternLinks, $categoryContent, $links, PREG_SET_ORDER);

            foreach ($links as $link) {
                $href = $link[1];
                $icon = $link[2];
                $content = $link[3];
                $description = '';

                if($isDescription){
                    $description = $this->GetDescription($href);
                }
                $categoryData['links'][] = array(
                    'href' => $href,
                    'icon' => $icon,
                    'title' => $content,
                    'description'   =>  $description
                );
            }

            $result[] = $categoryData;
        }
        if($isExportExcel)
            $this->ExportExcel($result);
        return $result;
    }


    /** 导出成 excel
     * @param array $data 需要导出的数据
     * @return bool
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private function ExportExcel($data){
        $list = [];
        foreach($data as $value){
            foreach ($value['links'] as $value1){
                $list[] = [
                    'category'  => $value['category'],
                    'title' =>  $value1['title'],
                    'href'  =>  $value1['href'],
                    "description"   =>  $value1['description'],
                    'icon'  =>  $value1['icon']
                ];
            }

        }
        $header = [
            ['类别', 'category', 'text'],
            ['标题', 'title'], // 规则不填默认text
            ['链接', 'href', 'text'],
            ['描述', 'description', 'text'],
            ['图标', 'icon', 'text'],
        ];
        return  Excel::exportData($list, $header);
    }

    /**获取 URL 的描述信息
     * @param $url
     * @return string
     */
    private function GetDescription($url){
        $stream_opts = [
            "ssl" => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ];
        $Rurl = 'https://api.yiyunt.cn/api/title?url='.$url;
        $result = json_decode(file_get_contents($Rurl,false,stream_context_create($stream_opts)),true);

        try{
            if($result['code']){
                return $result['data']['description'];
            }else{
                return "";
            }
        }catch (\Exception  $e){
            return '';
        }
    }
}
