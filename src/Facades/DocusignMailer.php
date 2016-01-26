<?php

namespace Tjphippen\Docusign\Facades;

use Illuminate\Support\Facades\Facade;

class DocusignMailer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'docusignmailer';
    }
}