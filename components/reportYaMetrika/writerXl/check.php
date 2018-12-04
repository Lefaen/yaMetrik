<?php
function checkChildXml($cell, $text, $elm)
{
    //var_dump($elm->attributes()->r);
    //var_dump($cell);
    //echo '<br><br>';
    if ($elm->attributes()->r == $cell ) {
        //$elm->addAttribute('t', 's');
        $elm->addChild('v', $text);
        if($cell == 'A14')
        {
            //echo '<br>SUCCESS '.$cell.': '. $text;
        }
        return true;
    } else {
        //echo '<br>ERROR ' . $cell .':'.$text.':'.$elm->attributes()->r;
        return false;
        //echo '<br>ERROR ' . $cell .':'.$text.':'.$elm->attributes()->r;
    }
}

function replaceChart($elm, $str)
{

}

function deleteChildXml($cell, $tag, $elm)
{
    if ($elm->attributes()->r == $cell) {
        $dom = dom_import_simplexml($elm->v);
        $dom->parentNode->removeChild($dom);

    }//else{
    //}
    //
    //if($elm->a)
}



?>