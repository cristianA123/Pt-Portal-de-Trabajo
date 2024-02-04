<?php

namespace App\Modules\Candidates\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Candidates\Repositories\RepoCandidates;
use App\Modules\Candidates\Contracts\ICandidates;
use Illuminate\Support\Facades\DB as FacadesDB;

class ServiceOrchestration extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ICandidates::class, function (){
            return new RepoCandidates(new FacadesDB);
        });
    }
}

?>