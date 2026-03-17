<?php

namespace App\View\Components;

use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\View\View;

class MenuComponent extends Component
{
    public function __construct(
        public string $location = 'header',
        public string $class = '',
        public string $ulClass = '',
        public string $itemClass = '',
        public string $linkClass = '',
        public string $dropdownClass = ''
    ) {}

    public function menu(): ?Menu
    {
        return Menu::getByLocation($this->location);
    }

    public function render(): View
    {
        return view('components.menu');
    }
}
