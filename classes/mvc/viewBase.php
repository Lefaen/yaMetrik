<?php

class viewBase
{
    public function createView($contentView, $templateView = 'template.php', $data = null)
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