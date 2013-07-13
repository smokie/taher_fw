<?php
/**
 * @author: smokiee
 * @date: 5/27/13
 * @package
 */
class Image
{

    const ALLOWED_EXTENSIONS = 'png,jpg,jpeg';

    private $imagePath;
    private $imageResource;
    private $extension;

    private $width;
    private $height;

    public function __construct($imagePath) {
        $this->imagePath = $imagePath;
        if (!file_exists($this->imagePath)) {
            throw new \Exception("File " . $this->imagePath . " Does not exist.");
        }

        $finfo = new finfo(FILEINFO_MIME);
        $info = $finfo->file($this->imagePath);

        if ($info === false || !preg_match('/image\/(.+); charset=binary/', $info, $matches)) {
            throw new \Exception("File " . $this->imagePath . " is not an image.");
        }

        $this->extension = strtolower($matches[1]);
        $allowedExtensions = explode(",", self::ALLOWED_EXTENSIONS);

        if (!in_array($this->extension, $allowedExtensions)) {
            throw new \Exception("File " . $this->imagePath . " is not an image.");
        }

        $this->create();

    }

    private function createFn() {
        $fn = 'imagecreate';
        switch ($this->extension) {
            case 'png':
                $fn = "imagecreatefrompng";
                break;
            case 'jpg':
            case 'jpeg':
                $fn = "imagecreatefromjpeg";
                break;
            case 'gif':
                $fn = "imagecreatefromgif";
                break;
        }
        return $fn;
    }

    /**
     * @return resource
     */
    public function getResource(){
        return $this->imageResource;
    }

    private function create() {
        $fn = $this->createFn();

        $this->imageResource = $fn($this->imagePath);

        $this->width= imagesx($this->imageResource);
        $this->height = imagesy($this->imageResource);
    }





}
