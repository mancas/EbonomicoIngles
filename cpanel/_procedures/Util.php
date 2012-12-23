<?php

global $errors;

class Util {

    protected $path;
    protected $errors;
    protected $maxSize;

    public function __construct()
    {
        $this -> errors = array();
        $this -> path = "/aptana/ebonomicoingles/_uploads/";
        $this -> maxSize = 1000000;
    }

    public function getErrors()
    {
        return $this -> errors;
    }

    public function getPath()
    {
        return $this -> path;
    }

    public function getMaxSize()
    {
        return $this -> maxSize;
    }

    public function setErrors($errors)
    {
        $this -> errors = $errors;
    }

    public function setPath($path)
    {
        $this -> path = $path;
    }

    public function setMaxSize($maxSize)
    {
        $this -> maxSize = $maxSize;
    }

    public function deleteFile()
    {
        $result = true;

        if (file_exists($this -> path)) {
            if (unlink($this -> path)) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        return $result;
    }

    public function moveUploadFile($file)
    {
        $result = false;

        if (move_uploaded_file($file, $this -> path)) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    public function isGif($type)
    {
        $result = false;
        if (strpos($type, 'gif') !== false) {
            $result = true;
        }

        return $result;
    }

    public function isJpg($type)
    {
        $result = false;
        if (strpos($type, 'jpg') !== false || strpos($type, 'jpeg') !== false) {
            $result = true;
        }

        return $result;
    }

    public function isPng($type)
    {
        $result = false;
        if (strpos($type, 'png') !== false) {
            $result = true;
        }

        return $result;
    }

    public function checkSize($fileSize)
    {
        $result = true;

        if ($fileSize > $this -> maxSize) {
            $result = false;
        }

        return $result;
    }

    public function checkUpload($options)
    {
        $errors = $this -> getErrors();

        foreach ($options as $key => $value) {
            if (empty($value) || !isset($value)) {
                $errors[$key] = 'Este campo no puede estar vacio';
            }
        }

        $this -> setErrors($errors);
    }

    public function sanitizeUrl($url)
    {
        if (!empty($url)) {
            if (strpos($url, 'http://') === false) {
                $result = 'http://' . $url;
            } else {
                $result = $url;
            }
        } else {
            $result = $url;
        }
        return $result;

    }

}
?>