<?php

namespace Ermakk\CSComponent\Components\Structure;

use IteratorAggregate;
use Ermakk\CSComponent\Contracts\StructureItemContract;
use Ermakk\CSComponent\Contracts\StructureItemsContract;
use Illuminate\Support\Collection;

class StructureItems implements StructureItemsContract, IteratorAggregate
{
    protected $items = [];

    public function append(StructureItemContract $item): void
    {
        $this->items[] = $item;
    }

    public function first(): ?StructureItem
    {
        return reset($this->items);
    }

    public function last(): ?StructureItem
    {
        return end($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function getIterator(): Collection
    {
        return collect($this->items);
    }

}
