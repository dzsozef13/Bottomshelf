<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "CommentModel",
    "CountryModel"
));

class CountryController
{

    public function fetchAll()
    {
        $countryModel = new CountryModel();
        return $countryModel->getAll();
    }
}
