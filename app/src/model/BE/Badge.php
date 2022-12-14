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
        return htmlspecialchars($this->badgeId);
    }

    public function getName()
    {
        return htmlspecialchars($this->badgeName);
    }

    public function getBadgeIcon()
    {
        $id = $this->badgeId;
        if ($id == 1) {
            return '<i class="las la-glass-cheers text-background-primary-900 text-2xl"></i>';
        } else if ($id == 2) {
            return '<i class="las la-users text-background-primary-900 text-2xl"></i>';
        } else if ($id == 3) {
            return '<i class="las la-certificate text-background-primary-900 text-2xl"></i>';
        }
    }
}
