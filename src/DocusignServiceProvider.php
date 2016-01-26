<?php namespace Tjphippen\Docusign;

use Illuminate\Support\ServiceProvider;

class DocusignServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('docusign.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('docusign', function ()
        {
            return new Docusign(config('docusign'));
        });

        $this->app->bind('DocusignMailer', function() {
            $docusign = new Docusign(config('docusign', array()));
            return new DocusignMailer($docusign);
        });

        $this->app->alias('Docusign', \Tjphippen\Docusign\Facades\Docusign::class);
        $this->app->alias("DocusignMailer", \Tjphippen\Docusign\Facades\DocusignMailer::class);
    }

    public function provides()
    {
        return ['docusign', 'docusignmailer'];
    }

}