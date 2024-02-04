<?php

namespace App\Modules\Tickets\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Tickets\Repositories\RepoTicket;
use App\Modules\Tickets\Contracts\ITicket;
use Illuminate\Support\Facades\DB as FacadesDB;

class ServiceOrchestration extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ITicket::class, function (){
            return new RepoTicket(new FacadesDB);
        });
    }
}

?>