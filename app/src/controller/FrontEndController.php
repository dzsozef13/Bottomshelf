<?php 
include_once 'autoload.php';
include_files(array(
    "Console",
));
class FrontEndController
{
    // for each page it needs a method which fetches all data is able to return it to a pge
   private static $request;

   public function __construct($req)
    {
        $this->buildPage($req);
    }

    public function buildPage() {
        
    }
}