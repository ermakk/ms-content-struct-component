<?php

namespace Ermakk\CSComponent\Converters;

use Ermakk\CSComponent\Contracts\ContentContract;
use Illuminate\Support\Str;
use MoonShine\Support\Traits\Makeable;

class Html implements ContentContract
{
    use Makeable;
    protected string $content = '';

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getHtmlContent(): string
    {
        return $this->content;
    }
}
