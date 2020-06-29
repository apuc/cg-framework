<?php


namespace core;


class PaginationHandler extends Widget
{
    /**
     * @var $pagination Pagination
     */
    protected $pagination;

    protected $data;

    /* Example
      $options = [
            'pagination' => [
                'per_page' => 5,
                'show' => [
                    'label' => '',
                    'value' => function($data) {
                        echo '<b>' . $data->username . '</b><br>';
                    }
                ]
            ]
        ];
     */
    protected $options;

    public function setParams($data, $url, $amount_of_data, $options)
    {
        $this->data = $data;
        $this->options = $options;
        $this->pagination = Pagination::widget();
        $this->pagination->setParams($url, $amount_of_data,
            isset($this->options['pagination']) ? $this->options['pagination'] : []);

        return $this;
    }

    public function getData()
    {
        $data  = '';
        $end = $this->pagination->getPage() * $this->pagination->getPerPage();
        $start = ($end - ($this->pagination->getPerPage() - 1)) - 1;

        if ($end > $this->pagination->getAmountOfData())
            $end = $this->pagination->getAmountOfData();

        for ($i = $start; $i < $end; $i++) {
            if(isset($this->options['pagination']['show']['label']))
                $data .= call_user_func($this->options['pagination']['show']['value'], $this->data[$i]);
            else
                $data .= $this->data[$i] . '<br>';
        }
    }

    public function run()
    {
        return $this->getData() . $this->pagination->run();
    }
}