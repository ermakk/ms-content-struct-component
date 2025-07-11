<?php

declare(strict_types=1);

namespace Ermakk\CSComponent\Components\StructureMenu;

use Closure;
use Ermakk\CSComponent\Components\Structure\StructureItem;
use MoonShine\UI\Components\AbstractWithComponents;

final class LinkGroup extends AbstractWithComponents
{
    protected string $view = 'ms-cs-component::components.structure-menu.index';

    public ?LinkItem $link = null;


    public function __construct(
        StructureItem $item,
        protected ?Closure $route = null
    )
    {


        $linkItem = new LinkItem(isset($this->route) ? value($this->route, $item) : '#'.$item->id(), $item->title());
        $this->link = ($icon = $item->icon()) ? $linkItem->icon($item->icon()) : $linkItem;
        $collection = collect();
        foreach ($item->children() as $chItem) {

            if($chItem->hasChildren()){

                $collection->add(new self($chItem, $this->route));
            } else {
                $collection->add(
                    (new LinkItem(
                        isset($this->route) ? value($this->route, $chItem) : '#'.$chItem->id(),
                        $chItem->title()
                    ))->icon($chItem->icon())
                );
            }

        }

        parent::__construct(
            $collection
        );
    }

}
