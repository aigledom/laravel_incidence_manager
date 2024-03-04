<?php

namespace App\View\Components;

use App\Models\Incidencia;
use Illuminate\View\Component;

class Map extends Component
{
    public $pagina;
    public $ubicacion;
    public function __construct($pagina,$ubicacion = null)
    {
        $this->pagina = $pagina;
        $this->ubicacion = $ubicacion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.map');
    }
}
