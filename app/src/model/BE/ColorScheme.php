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
        return $this->colorSchemeId;
    }
    public function getColorSchemeName()
    {
        return $this->colorSchemeName;
    }

    public function getHighlight()
    {
        return $this->highlightColor;
    }

    public function getBackgroundPrimary()
    {
        return $this->backgroundPrimary;
    }

    public function getBackgroundSecondary()
    {
        return $this->backgroundSecondary;
    }

    public function getBackgroundTernary()
    {
        return $this->backgroundTernary;
    }

    public function getLightColor()
    {
        return $this->light;
    }
}
