<?php

declare(strict_types=1);

namespace Ermakk\CSComponent\Components\StructureMenu;

use Closure;
use Ermakk\CSComponent\Components\Structure\StructureItem;
use Illuminate\Support\Collection;
use MoonShine\UI\Components\AbstractWithComponents;

final class LinkGroup extends AbstractWithComponents
{
    protected string $view = 'moonshine-cs-component::components.structure-menu.index';

    public ?LinkItem $link = null;
    protected ?Closure $route = null;
    public function __construct(StructureItem $item)
    {

        $this->link = (new LinkItem(isset($this->route) ? $this->route($item) : '#'.$item->id(), $item->title()))->icon($item->icon());
        $collection = collect();
        foreach ($item->children() as $chItem) {

            if($chItem->hasChildren()){

                $collection->add((new self($chItem))->setRoute($this->route));
            } else {
                $collection->add(
                    (new LinkItem(
                        isset($this->route) ? $this->route($chItem) : '#'.$chItem->id(),
                        $chItem->title()
                    ))->icon($chItem->icon())
                );
            }


//            $collection->add(
//                new LinkItem(
//                    isset($this->route) ? $this->route($chItem) : '#'.$chItem->id(),
//                    $chItem->title()
//                )
//            );
        }

        parent::__construct(
            $collection
        );
    }
    /**
     * @param Closure|null $route
     */
    public function setRoute(?Closure $route): static
    {
        $this->route = $route;
        return $this;
    }
}
