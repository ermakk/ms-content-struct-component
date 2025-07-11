<?php

namespace Ermakk\CSComponent\Converters;

use Ermakk\CSComponent\Contracts\ContentContract;
use Illuminate\Support\Str;
use MoonShine\Support\Traits\Makeable;

class MarkdownConverter implements ContentContract
{
    use Makeable;

    public function __construct(protected string $content = '')
    {
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getHtmlContent(): string
    {
        return Str::markdown($this->content);
    }
}
