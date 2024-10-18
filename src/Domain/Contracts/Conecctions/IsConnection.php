<?php

namespace CemeteryManagement\Contracts\Conections;

use Illuminate\Database\Capsule\Manager;

interface IsConnection
{
    /**
     * Configure Capsule manager for connect database type
     *
     * @param  Manager $capsule Capsule Manager
     *
     * @return void
     */
    public function preConfigure(Manager $capsule);
}