<?php


namespace core;


class View
{
    public $title = 'No title';
    public $meta = [];
    public $js = [];

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function addMeta($name, $content, $params = [])
    {
        $this->meta[] = ['name' => $name, 'content' => $content, 'params' => $params];
    }

    public function getMetaHtml()
    {
        $metaHtml = '';
        foreach ($this->meta as $item) {
            $params = $this->generateAdditionalParams($item['params']);
            $metaHtml .= "<meta name='" . $item['name'] . "' content='" . $item['content'] . "' " . $params . " >" . "\n";
        }
        return $metaHtml;
    }

    public function registerJs($js, $params = [], $endOfBody = false)
    {
        $this->js[] = ['src' => $js, 'params' => $params, 'endOfBody' => $endOfBody];
    }

    public function getJsHtml($endOfBody = false)
    {
        $jsHtml = '';
        foreach ((array)$this->js as $j){
            $params = $this->generateAdditionalParams($j['params']);
            if($j['endOfBody'] === $endOfBody){
                $jsHtml .= "<script src='". $j['src'] ."' " . $params . " ></script>" . "\n";
            }
        }
        return $jsHtml;
    }

    private function generateAdditionalParams($data)
    {
        $params = '';
        foreach ((array)$data as $key => $datum) {
            $params .= $key . '="' . $datum . '" ';
        }

        return $params;
    }

}