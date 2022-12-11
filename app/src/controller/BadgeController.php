<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "BadgeModel"
));

class BadgeController
{

    public function fetchAllByUserId(int $userId)
    {
        $badgeModel = new BadgeModel();
        return $badgeModel->getByUserId($userId);
    }
}
