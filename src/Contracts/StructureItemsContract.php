<?php

namespace Ermakk\CSComponent\Contracts;

use Illuminate\Support\Collection;

interface StructureItemsContract
{
    public function append(StructureItemContract $item): void;

    public function first(): ?StructureItemContract;

    public function last(): ?StructureItemContract;

    public function isEmpty(): bool;

    public function getIterator(): iterable;
}
