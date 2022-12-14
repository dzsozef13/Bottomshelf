<?php

class ColorScheme
{

    private $colorSchemeId;
    private $colorSchemeName;
    private $highlightColor;
    private $backgroundPrimary;
    private $backgroundSecondary;
    private $backgroundTernary;
    private $light;

    function __construct(
        $colorSchemeId,
        $colorSchemeName,
        $highlightColor,
        $backgroundPrimary,
        $backgroundSecondary,
        $backgroundTernary,
        $light
    ) {
        $this->colorSchemeId = $colorSchemeId;
        $this->colorSchemeName = $colorSchemeName;
        $this->highlightColor = $highlightColor;
        $this->backgroundPrimary = $backgroundPrimary;
        $this->backgroundSecondary = $backgroundSecondary;
        $this->backgroundTernary = $backgroundTernary;
        $this->light = $light;
    }

    public function getId()
    {
        return htmlspecialchars($this->colorSchemeId);
    }
    public function getColorSchemeName()
    {
        return htmlspecialchars($this->colorSchemeName);
    }

    public function getHighlight()
    {
        return htmlspecialchars($this->highlightColor);
    }

    public function getBackgroundPrimary()
    {
        return htmlspecialchars($this->backgroundPrimary);
    }

    public function getBackgroundSecondary()
    {
        return htmlspecialchars($this->backgroundSecondary);
    }

    public function getBackgroundTernary()
    {
        return htmlspecialchars($this->backgroundTernary);
    }

    public function getLightColor()
    {
        return htmlspecialchars($this->light);
    }
}
