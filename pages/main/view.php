<div>
    <?if(isset($_SESSION['id'])):?>
    <? component::includeComponent('reportYaMetrika');?>
    <?endif;?>
    <? //if($_SESSION['login'] == 'test')
        //phpinfo();
        ?>
</div>