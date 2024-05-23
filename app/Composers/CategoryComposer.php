<?php

namespace App\Composers;

use App\Models\Pets;
use App\Models\Servieces;
use Illuminate\View\View;

class CategoryComposer
{
    protected $pet;
    protected $serviece;
    /**
     * Create a new profile composer.
     */
    public function __construct(Pets $pet, Servieces $serviece) {
        $this->pet = $pet;
        $this->serviece = $serviece;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
                    'pet' => $this->pet->with('categories')->where('status','active')->get(),
                    'serviece' => $this->serviece->where('status','active')->get(),
        ]);
    }
}
