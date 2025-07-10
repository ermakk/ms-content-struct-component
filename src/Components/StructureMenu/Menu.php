<?php

declare(strict_types=1);

namespace Ermakk\CSComponent\Components\StructureMenu;

use Closure;
use Ermakk\CSComponent\Components\Structure\StructureItem;
use Ermakk\CSComponent\Contracts\ContentContract;
use Ermakk\CSComponent\Contracts\StructureParserContract;
use Ermakk\CSComponent\Parsers\HtmlParser;
use MoonShine\UI\Components\MoonShineComponent;


/**
 * @method static static make(ContentContract $content, StructureParserContract|string|null $parser = null, ?Closure $route = null)
 */
final class Menu extends MoonShineComponent
{
    protected ?iterable $components = null;

    protected string $view = 'moonshine-cs-component::components.structure-menu.menu';

    protected string $title = 'Оглавление:';

    protected string $placeholder = 'пусто';

    protected bool $simpleMode = false;
    /**
     * @throws \Throwable
     */
    public function __construct(
        protected ContentContract $content,
        protected StructureParserContract|string|null $parser = null,
        protected ?Closure $route = null
    )
    {
        parent::__construct();
    }

    protected function getComponents(): iterable
    {
        $this->components = collect();
        foreach ($this->getParser()->getItems() as $item){
            if($item->hasChildren()){

                $this->components->add(new LinkGroup($item, $this->route));
            } else {
                $this->components->add(
                    new LinkItem(
                        isset($this->route) ? value($this->route, $item) : '#'.$item->id(),
                        $item->title()
                    )
                );
            }
        }
        return $this->components;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setPlaceholder(string $title): static
    {
        $this->title = $title;
        return $this;
    }
    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function simpleMode(bool $condition = true): static
    {
        $this->simpleMode = $condition;
        return $this;
    }
    public function getSimpleMode(): bool
    {
        return $this->simpleMode;
    }

    public function getParser(): StructureParserContract
    {
        if(is_null($this->parser))
            $this->parser = new HtmlParser($this->content);

        if(is_string($this->parser) && in_array(StructureParserContract::class, class_implements($this->parser)))
            $this->parser = new $this->parser($this->content);

        if(!($this->parser instanceof StructureParserContract))
            throw new \Exception($this->parser::class.' is not an instance of StructureParserContract');

        return $this->parser;
    }

    public function getNewHtml(&$content): static
    {
        $content = $this->getParser()->getNewHtml();
        return $this;
    }

    /**
     * @return array<string, mixed>
     * @throws Throwable
     */
    protected function systemViewData(): array
    {
        return [
            ...parent::systemViewData(),
            'components' => $this->getComponents(),
            'title' => $this->getTitle(),
            'placeholder' => $this->getPlaceholder(),
            'simpleMode' => $this->getSimpleMode(),
        ];
    }

}
