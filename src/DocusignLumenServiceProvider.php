<?php

namespace Tjphippen\Docusign;


use Illuminate\Support\ServiceProvider;
use Tjphippen\Docusign\Facades\DocusignMailer;

class DocusignLumenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->configure('docusign');
    }

    public function register()
    {
        $this->app->bind('docusign', function ()
        {
            return new Docusign(config('docusign', array()));
        });

        $this->app->bind('DocusignMailer', function() {
            $docusign = new Docusign(config('docusign', array()));
            return new DocusignMailer($docusign);
        });

        if ( ! class_exists('Docusign') ) {
            class_alias('Tjphippen\Docusign\Facades\Docusign', 'Docusign');
        }

        if ( ! class_exists('DocusignMailer') ) {
            class_alias('Tjphippen\Docusign\Facades\DocusignMailer', 'DocusignMailer');
        }
    }

    public function provides()
    {
        return ['docusign', 'docusignmailer'];
    }

}