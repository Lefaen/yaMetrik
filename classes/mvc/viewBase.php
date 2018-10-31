<?php

class viewBase
{
    public function createView($contentView, $templateView, $data = null)
    {
        if($templateView != '')
        {
            include 'template/.default/' . $templateView;
        }
        else
        {
            include $contentView;
        }
    }
}

?>