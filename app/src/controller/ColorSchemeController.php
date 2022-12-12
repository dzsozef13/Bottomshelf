<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "ColorSchemeModel"
));

class ColorSchemeController
{

    public function fetchAll()
    {
        $colorSchemeModel = new ColorSchemeModel();
        return $colorSchemeModel->getAll();
    }

    public function fetchById(int $colorSchemeId)
    {
        $colorSchemeModel = new ColorSchemeModel();
        return $colorSchemeModel->getById($colorSchemeId);
    }
}
