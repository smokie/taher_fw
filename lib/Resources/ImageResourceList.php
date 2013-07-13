<?php
/**
 * @author: smokiee
 * @date: 5/28/13
 * @package
 */

namespace Resources;

class ImageResourceList extends ResourceList
{
    protected $spriteSheet;
    protected $images = array();

    const SEPARATOR_PX = 2;

    const COLS = 4;
    const ROWS = 4;

    /**
     * @param $rfile
     * @return \Image
     */
    protected function getResourceContent($rfile) {
        return new \Image($rfile);
    }

    /**
     * @param $listName
     * @return resource
     */
    public function getContent($listName, $mod= '') {
        if (!$this->loaded) {
            $this->loadListContents($listName, $mod);
        }
        return $this->spriteSheet;
    }

    protected function loadListContents($listName, $mod = '') {
        $paths = $this->getPaths($listName);

        $w = 0;
        $h = 0;

        $sizes = array();
        foreach ($paths as $path) {
            list($width, $height) = getimagesize($path);
            $w += intval($width) + self::SEPARATOR_PX;
            $h += intval($height) + self::SEPARATOR_PX;
            $sizes[] = array($width, $height);
        }

        $cols = self::COLS <= count($path) ? : count($path);

        $w = round($w / $cols);
        $h = round($h * $cols);

        if (($this->spriteSheet = imagecreatetruecolor($w, $h)) === false) {
            throw new \Core\Exception("Can't create sprite image...");
        }

        $currentX = 0;
        $currentY = 0;

        $lowest = 0;
        $totalY = 0;

        $i = 0;

        \System::i()->setTimeLimit(0);
        \System::i()->iniSet('memory_limit', '500M');

        foreach ($paths as $path) {
            $image = $this->getResourceContent($path);
            $src = $image->getResource();

            if (($currentX + $sizes[$i][0]) > $w) {
                $currentX = 0;
                $currentY = $totalY + self::SEPARATOR_PX;
                $totalY += $lowest;
                $lowest = 0;
            }

            imagecopy(
                $this->spriteSheet,
                $src,
                $currentX,
                $currentY,
                0,
                0,
                $sizes[$i][0],
                $sizes[$i][1]
            );


            \ClassFactory::cache()->set(basename($path),
                array(
                    'x'    => $currentX,
                    'y'    => $currentY,
                    'w'    => $sizes[$i][0],
                    'y'    => $sizes[$i][1],
                    'list' => $listName,
                    'mod'  => $mod)
                , 'images');

            $currentX += $sizes[$i][0];
            if (!$lowest || $sizes[$i][1]) {
                $lowest = $sizes[$i][1];
            }


            $i++;

        }

//        \System::i()->reset("time_limit");

    }

}
