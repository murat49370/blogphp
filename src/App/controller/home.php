<?php

require(dirname(__DIR__) . '/src/App/model/manager/postManager.php');

$req = getBillets();

require('affichageAccueil.php');
