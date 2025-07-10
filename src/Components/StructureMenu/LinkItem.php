<?php

declare(strict_types=1);

namespace Ermakk\CSComponent\Components\StructureMenu;

use MoonShine\Contracts\UI\HasIconContract;
use MoonShine\UI\Components\MoonShineComponent;
use MoonShine\UI\Traits\WithIcon;

/**
 * @method static static make(string $href, string $title, ?string $description = null)
 */
final class LinkItem extends MoonShineComponent implements HasIconContract
{
    use WithIcon;

    protected string $view = 'moonshine-cs-component::components.structure-menu.item';

    public function __construct(
        private string $href,
        private string $title,
        private ?string $description = null,
    ) {
        parent::__construct();
    }

    protected function viewData(): array
    {
        return [
            'href' => $this->href,
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->getIcon(5, attributes: [
                'class' => 'flex',
            ]),
        ];
    }
}
