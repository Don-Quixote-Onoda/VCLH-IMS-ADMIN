<?php

namespace App\Http\Controllers;

use TCPDF;

class CustomTCPDF extends TCPDF
{
    protected $actionPath;

    public function SetActionPath($path)
    {
        $this->actionPath = $path;
    }

    public function AddPage($orientation = '', $format = '', $keepmargins = false, $tocpage = false)
    {
        parent::AddPage($orientation, $format, $keepmargins, $tocpage);

        if (!empty($this->actionPath)) {
            $this->SetLink($this->actionPath);
        }
    }
}
