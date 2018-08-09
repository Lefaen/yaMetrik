<?php
function checkChildXml($cell, $text, $elm)
{
    //var_dump($elm->attributes()->r);
    //var_dump($cell);
    if ($elm->attributes()->r == $cell) {
        //$elm->addAttribute('t', 's');
        $elm->addChild('v', $text);
    }//else {
    //echo 'error ';
    //}
}

function deleteChildXml($cell, $tag, $elm)
{
    if($elm->attributes()->r == $cell){
        $dom = dom_import_simplexml($elm->v);
        $dom->parentNode->removeChild($dom);

    }//else{
    //}
    //
    //if($elm->a)
}

?>