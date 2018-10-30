<?

class signInModel extends modelBase
{
    private $data;
    public function getData()
    {
        if(!empty($_POST))
        {
            $this->data = $_POST;
        }
        return $this->data;
    }
}

?>