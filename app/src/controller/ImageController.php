<?php

// Inclass code, may be deleted, only kept for reference

class ImageController {

    protected $image;
    protected $image_type;

    public function load($filename) {
        $image_info = getimagesize($filename);
        $this->image_type = $iamge_size[2];

        if ($this->image_type == IMAGETYPE_GIF) {
            this$->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_JPEG) {
            this$->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            this$->image = imagecreatefromgif($filename);
        }
    }

    protected function getWidth() {
        return imagesx($this->image);
    }

    protected function getHeight() {
        return imagesx($this->image);
    }

    public function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
    }

} 