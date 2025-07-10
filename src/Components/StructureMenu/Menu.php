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
 * @method static static make(ContentContract $content, Closure $route, StructureParserContract|string|null $parser = null)
 */
final class Menu extends MoonShineComponent
{
    protected $components = [];

    protected ?Closure $route = null;
    protected string $view = 'moonshine-cs-component::components.structure-menu.menu';

    public $title = 'Оглавление:';
    public $placeholder = 'пусто';
    public bool $simpleMode = false;
    /**
     * @throws \Throwable
     */
    public function __construct(
        ContentContract $content,
        protected StructureParserContract|string|null $parser = null
    )
    {
        if(is_null($parser))
            $this->parser = new HtmlParser($content);
        $this->components = collect();
        foreach ($this->parser->getItems() as $item){
            if($item->hasChildren()){

                $this->components->add((new LinkGroup($item))->setRoute($this->route));
            } else {
                $this->components->add(
                    new LinkItem(
                        isset($this->route) ? $this->route($item) : '#'.$item->id(),
                        $item->title()
                    )
                );
            }
        }
        debugbar()->addMessage($this->components);
        parent::__construct();
    }

    public function simpleMode(bool $condition = true): static
    {
        $this->simpleMode = $condition;
        return $this;
    }
    /**
     * @param Closure|null $route
     */
    public function setRoute(?Closure $route): void
    {
        $this->route = $route;
    }

    public function getParser(): StructureParserContract
    {
        return $this->parser;
    }
    public function getNewHtml(): string
    {
        return $this->newHtml;
    }
    /**
     * @return array<string, mixed>
     * @throws Throwable
     */
    protected function systemViewData(): array
    {
        return [
            ...parent::systemViewData(),
            'components' => $this->components,
        ];
    }

}
