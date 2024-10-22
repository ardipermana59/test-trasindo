<?php

namespace App\Services;

use App\Models\Information;

class InformationService
{
    public function getPaginatedInformations($perPage = 5)
    {
        return Information::orderByDesc('id')->paginate($perPage);
    }
}
