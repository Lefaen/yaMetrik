<?

class signInModel extends modelBase
{
    private $data;
    public function getData()
    {
        if(!empty($_POST) && !isset($_POST['signUp']))
        {
            $this->data = $_POST;
        }
        if ($_GET['action'] == 'logout')
        {
            $this->data['logout'] = true;
        }
        return $this->data;
    }
}

?>