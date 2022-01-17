<?php

require_once('Views/View.php');

class Router
{
    private $_ctrl; // Controller
    private $_view; // View

    public function routeReq() // Requete routeur
    {
        try
        {
            // Chargement automatique des class Models :
            spl_autoload_register(function($class){
                require_once('Models/'.$class.'.php');
            });

            $url = '';

            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'],
                FILTER_SANITIZE_URL));

                $controller = explode('&', $url[0]);
                $controller = ucfirst(strtolower($controller[0]));
                $controllerClass = 'Controller'.$controller;
                $controllerFile = 'Controller/'.$controllerClass.'.php';
            
                if(file_exists($controllerFile))
                {
                    // Création de l'objet demandé :
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else
                    throw new Exception('Page introuvable');
            }
            else
            {
                require_once('Controller/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }
        // Gestion d'erreurs :
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }

}
