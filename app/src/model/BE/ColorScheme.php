<?php

class ColorScheme
{

    private int $colorSchemeId;
    private string $colorSchemeName;
    private string $highlightColor;
    private string $backgroundPrimary;
    private string $backgroundSecondary;
    private string $backgroundTernary;
    private string $light;

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

    public function getId(): int
    {
        return $this->colorSchemeId;
    }
    public function getColorSchemeName(): string
    {
        return htmlspecialchars($this->colorSchemeName);
    }

    public function getHighlight(): string
    {
        return htmlspecialchars($this->highlightColor);
    }

    public function getBackgroundPrimary(): string
    {
        return htmlspecialchars($this->backgroundPrimary);
    }

    public function getBackgroundSecondary(): string
    {
        return htmlspecialchars($this->backgroundSecondary);
    }

    public function getBackgroundTernary(): string
    {
        return htmlspecialchars($this->backgroundTernary);
    }

    public function getLightColor(): string
    {
        return htmlspecialchars($this->light);
    }
}
