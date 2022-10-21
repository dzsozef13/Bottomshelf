<?php 
include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
));
class PageController
{
    public function renderViewOnly($view)
    {

        require $_SERVER['DOCUMENT_ROOT']."/src/view/" . $view . ".php";
    }
}