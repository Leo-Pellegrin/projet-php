<?php

class View
{
    private $_file;

    public function __construct($action)
    {
        $this->_file = 'Views/view'.$action.'.php';
    }

    public function generate($data)
    {
        $content = $this->generateFile($this->_file, $data);
        echo $content;
    }

    public function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);
            ob_start();

            require $file;
            return ob_get_clean();
        }
        else
            throw new Exception('Page introuvable');
    }
}