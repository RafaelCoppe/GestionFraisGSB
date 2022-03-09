<?php

class logEvenementsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/DemandeRemboursementRepository.php');
        require_once(ROOT . '/model/repository/TypeFraisRepository.php');
        require_once(ROOT . '/model/entity/LogEvenements.php');
        require_once(ROOT . '/model/entity/Action.php');
        require_once(ROOT . '/model/entity/Table.php');
    }
};
