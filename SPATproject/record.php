<?php
require_once('Models/formDataSet.php');

$view = new stdClass();
$view->pageTitle = 'STS Records';

$formDataSet = new formDataSet();

if(isset($_GET['search']) && !empty($_GET['search']) ) // If the user clicks on search, search for people
{
    $view->formDataSet = $formDataSet->search($_GET['search']);
    $view->pageTitle = 'search';
}

else
{
    $view->formDataSet = $formDataSet->fetchAllForms();
    $view->pageTitle = 'STS Records';
}

require_once('Views/record.phtml');

