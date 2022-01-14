<?php
require 'www/Models/';
class Controller{

    public function homeController(){
        ob_start();

        $EntityRepo = new EntityRepo();
        $campagnes = $EntityRepo->findAll('campagne');

        include('Views/home.php');
        $html = ob_end_flush();

        return $html;
    }

    public function campagneController($campagne){
        ob_start();

        $EvenementRepo = new EvenementRepo();
        $evenements = $EvenementRepo->findAllEvenement($campagne);

        include('Views/evenement.php');
        $html = ob_end_flush();

        return $html;
    }

    public function evenementController($campagne, $id){
        ob_start();

        $EvenementRepo = new EvenementRepo();
        $evenement = $EvenementRepo->findEvenement($campagne, $id);

        include('Views/inprogressevenement.php');
        $html = ob_end_flush();

        return $html;
    }

    public function demandeController(){
        ob_start();

        $EntityRepo = new EntityRepo();
        $demandes = $EntityRepo->findAll('demande');
        if($_POST['action'] == 'Accepter'){
            header('Location: demandevalidation.php');
        }
        elseif($_POST['action'] == 'Refuser'){
            $EntityRepo->delete('demande', $_GET['demande']);
        }

        include('Views/demande.php');
        $html = ob_end_flush();

        return $html;
    }

    public function campagneformController(){
        ob_start();

        include('Views/campagneform.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $CampagneRepo = new CampagneRepo();
            $CampagneRepo->add();
        }
        $html = ob_end_flush();

        return $html;
    }

    public function evenementformController(){
        ob_start();

        include('Views/evenementform.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $EvenementRepo = new EvenementRepo();
            $EvenementRepo->add();
        }

        $html = ob_end_flush();

        return $html;
    }

    public function formController(){
        ob_start();

        include('Views/form.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $DemandeRepo = new DemandeRepo();
            $DemandeRepo->add();
        }

        $html = ob_end_flush();

        return $html;
    }

    public function demandevalidationController($email){
        ob_start();

        include('Views/demandevalidation.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $DemandeRepo = new DemandeRepo();
            $datas = $DemandeRepo->addUser();

            $EntityRepo = new EntityRepo();
            $EntityRepo->delete('demande', $_GET['demande']);

            mail($email,
            'Demande de compte sur Event-Io',
            'Bonjour, votre identifiant est ' . $datas[0] . ' et votre mot de passe est ' . $datas[1] .'. <br> En vous attendant au plus vite sur Event-IO ! <br> Cordialement, L\'équipe d\'Event-IO!', '',
            'From: projet.phpiutaix@gmail.com');
        }
    }

    public function jurycampagneController(){
        ob_start();

        $JuryRepo = new JuryRepo();
        $JuryRepo->findAllEndCampagne();

        include('Views/jurycampagne.php');
        $html = ob_end_flush();

        return $html;
    }

    public function juryevenementController($campagne){
        ob_start();

        $JuryRepo = new JuryRepo();
        $JuryRepo->findAllSuccesEvenement($campagne);

        include('Views/juryevenement.php');
        $html = ob_end_flush();

        return $html;
    }

    public function loginController(){
        ob_start();

        include('Views/login.php');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $loginrepo = new LoginRepo();
            $_SESSION['role'] = $loginrepo->login();
        }

        $html = ob_end_flush();

        return $html;
    }

    public function profilController($id){
        ob_start();

        $EntityRepo = new EntityRepo();
        $profil = $EntityRepo->find('user', $id);

        include('Views/profil.php');
        $html = ob_end_flush();

        return $html;
    }

    public function errorController(){
        ob_start();

        include('Views/error.php');
        $html = ob_end_flush();

        return $html;
    }



}
