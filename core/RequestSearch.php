<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.06.20
 * Time: 23:55
 */

namespace core;


class RequestSearch extends Request
{

    /**
     * Загружаем свойсва
     * @param array $data
     */
    public function load($data = [])
    {
        if (!empty($_REQUEST)) {
            foreach ($_REQUEST as $key => $item) {
                $key = str_replace("Search", "", $key);
                $this->{$key} = $item;
                $this->data[$key] = $item;
            }
        }
        elseif (!empty($data)){
            foreach ($data as $key => $item){
                $this->{$key} = $item;
                $this->data[$key] = $item;
            }
        }
    }

}