<?php

class Controller{

    public function homeController(){
        ob_start();

        $EntityRepo = new EntityRepo();
        $campagne = $EntityRepo->findAll('campagne');

        include('Views/home.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function campagneController($campagne){
        ob_start();

        $EvenementRepo = new EvenementRepo();
        $evenements = $EvenementRepo->findAllEvenement($campagne);

        include('Views/evenements.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function evenementController($campagne, $id){
        ob_start();

        $EvenementRepo = new EvenementRepo();
        $evenement = $EvenementRepo->findEvenement($campagne, $id);

        include('Views/inprogressevenement.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function demandeController(){
        ob_start();

        $DemandeRepo = new EntityRepo();
        $demandes = $DemandeRepo->findAll('demande');

        include('Views/demande.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function campagneformController(){
        ob_start();

        include('Views/campagneform.phtml');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $CampagneRepo = new CampagneRepo();
            $CampagneRepo->add();
        }
        $html = ob_end_flush();

        return $html;
    }

    public function evenementformController(){
        ob_start();

        include('Views/evenementform.phtml');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $EvenementRepo = new EvenementRepo();
            $EvenementRepo->add();
        }

        $html = ob_end_flush();

        return $html;
    }

    public function formController(){
        ob_start();

        include('Views/form.phtml');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $DemandeRepo = new DemandeRepo();
            $DemandeRepo->add();
        }

        $html = ob_end_flush();

        return $html;
    }

    public function jurycampagneController(){
        ob_start();

        $JuryRepo = new JuryRepo();
        $JuryRepo->findAllEndCampagne();

        include('Views/jurycampagne.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function juryevenementController($campagne){
        ob_start();

        $JuryRepo = new JuryRepo();
        $JuryRepo->findAllSuccesEvenement($campagne);

        include('Views/juryevenement.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function loginController(){
        ob_start();

        include('Views/login.phtml');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        }

        $html = ob_end_flush();

        return $html;
    }

    public function profilController($id){
        ob_start();

        $EntityRepo = new EntityRepo();
        $profil = $EntityRepo->find('user', $id);

        include('Views/profil.phtml');
        $html = ob_end_flush();

        return $html;
    }

    public function errorController(){
        ob_start();

        include('Views/error.phtml');
        $html = ob_end_flush();

        return $html;
    }



}
