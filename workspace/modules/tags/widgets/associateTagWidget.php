<?php

namespace workspace\modules\tags\widgets;

use core\Widget;

class associateTagWidget extends Widget
{
    public $viewPath = "/modules/tags/widgets/views";

    public function run()
    {
        echo $this->render('associateView.tpl');
    }

}