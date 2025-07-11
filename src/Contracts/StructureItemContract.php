<?php

namespace Ermakk\CSComponent\Contracts;

interface StructureItemContract
{
    public function title(): string;

    public function id(): string;

    public function setId(string $id): self;

    public function icon(): ?string;

    public function level(): int;

    public function children(): StructureItemsContract;

    public function hasChildren(): bool;

    public function appendChild(StructureItemContract $item): void;

}
