<?php

class Badge
{

    private int $badgeId;
    private string $badgeName;

    function __construct(
        $badgeId,
        $badgeName
    ) {
        $this->badgeId = $badgeId;
        $this->badgeName = $badgeName;
    }

    public function getId(): int
    {
        return $this->badgeId;
    }

    public function getName(): string
    {
        return htmlspecialchars($this->badgeName);
    }

    public function getBadgeIcon(): string
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
