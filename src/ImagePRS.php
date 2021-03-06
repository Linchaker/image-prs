<?php
declare(strict_types=1);

namespace Linchaker\ImagePRS;

class ImagePRS extends Manager
{
    public function save(string $path, array $resize, string $pathToSave = null): string
    {
        // parse/valid path and return stream
        $img = $this->parser->parse($path);

        if ($img === 'false') {
            return 'false';
        }

        // resize img if need
        if (!empty($resize)) {
            try {
                $img = $this->resizer->resize($img, $resize);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        // save image to storage and return filename
        $filename = $this->saver->save($img, $pathToSave ?? $this->pathToSave);

        return $filename;
    }
}
