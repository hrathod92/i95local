<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $siteName = $_SERVER["SERVER_NAME"];
        
        $sites = \App\Site::all();
      
        $siteId = 1;
      
        foreach($sites as $site)
        {
            if($siteName == $site->url)
            {
                $siteId = $site->id;
            }
        }
      
        /*switch($siteName)
        {
            case "med-mutual-2.cg-dev2.com":  $siteId = 2;
                                              break;
            
            case "med-mutual-3.cg-dev2.com":  $siteId = 3;
                                              break;
        }*/
     
        $this->app->instance('siteId', $siteId);
    }
}