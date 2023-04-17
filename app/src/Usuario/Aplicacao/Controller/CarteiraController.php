<?php

namespace App\src\Usuario\Aplicacao\Controller;

use App\Http\Controllers\Controller;
use App\src\Usuario\Aplicacao\Service\CarteiraService;

class CarteiraController extends Controller
{
    public function __construct(
        private CarteiraService $carteiraService
    ) {
    }
}
