<?php

global $errors;

class Util {
    
    protected $path = "/aptana/ebonomicoingles/_uploads/";

    public function deleteFile($path)
    {
        $result = array();

        if (file_exists($path)) {
            $result['exists'] = true;

            if (unlink($path)) {
                $result['delete'] = true;
            } else {
                $result['delete'] = false;
            }
        } else {
            $result['exists'] = false;
        }

        return $result;
    }

    public function moveUploadFile($file, $path)
    {
        $result = false;

        if (move_uploaded_file($file, $path)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    public function isGif($type)
    {
        $result = false;
        if (strpos($type, 'gif')) {
            $result = true;
        }

        return $result;
    }

    public function isJpg($type)
    {
        $result = false;
        if (strpos($type, 'jpg') || strpos($type, 'jpeg')) {
            $result = true;
        }

        return $result;
    }

    public function isPng($type)
    {
        $result = false;
        if (strpos($type, 'png')) {
            $result = true;
        }

        return $result;
    }

    public function checkSize($fileSize, $maxSize)
    {
        $result = true;

        if ($fileSize > $maxSize) {
            $result = false;
        }

        return $result;
    }

    public function checkUpload($options)
    {
        $result = true;

        foreach ($options as $key => $value) {
            $result = $result && $this->isNotEmptyField($key, $value);
        }
        
        return $result;
    }

    public function isNotEmptyField($key, $value)
    {
        $result = true;
        if (empty($value) || !isset($value)) {
            $GLOBALS['errors'][$key] = "<strong>Error:</strong> Este campo no puede estar vacio";
            $result = false;
        }
        
        return $result;
    }
    
    public function getPath()
    {
        return $this->path;
    }
}
?>