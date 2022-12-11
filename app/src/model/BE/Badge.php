<?php

class Badge
{

    private $badgeId;
    private $badgeName;

    function __construct(
        $badgeId,
        $badgeName
    ) {
        $this->badgeId = $badgeId;
        $this->badgeName = $badgeName;
    }

    public function getId()
    {
        return $this->badgeId;
    }

    public function getName()
    {
        return $this->badgeName;
    }

    public function getBadgeIcon()
    {
        $id = $this->badgeId;
        if ($id == 1) {
            return '<i class="las la-glass-cheers"></i>';
        } else if ($id == 2) {
            return '<i class="las la-users"></i>';
        } else if ($id == 3) {
            return '<i class="las la-certificate"></i>';
        }
    }
}
