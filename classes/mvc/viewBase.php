<?php

class viewBase
{
    public function createView($contentView, $templateView, $data = null)
    {
        if($templateView != '')
        {
            include $_SERVER['DOCUMENT_ROOT'] . '/template/.default/' . $templateView;
        }
        else
        {
            include $contentView;
        }
    }
}

?>