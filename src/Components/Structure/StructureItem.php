<?php

namespace Ermakk\CSComponent\Components\Structure;

use Ermakk\CSComponent\Contracts\StructureItemContract;

class StructureItem implements StructureItemContract
{
    protected StructureItems $children;

    public function __construct(
        protected string $title,
        protected string $level,
        protected ?string $id = null,
        protected ?string $icon = null,
    )
    {
        $this->children = new StructureItems(); // коллекция дочерних элементов
    }
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function id(): string
    {
        return $this->id ?? '';
    }


    public function title(): string
    {
        return $this->title;
    }
    public function icon(): string
    {
        return $this->icon;
    }

    public function level(): int
    {
        return $this->level;
    }

    public function children(): StructureItems
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return !$this->children->isEmpty();
    }

    public function appendChild(StructureItemContract $item): void
    {
        $this->children->append($item);
    }
}
