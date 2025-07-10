<?php

namespace Ermakk\CSComponent\Contracts;

interface ContentContract
{

    public function setContent(string $content): self;
    public function getHtmlContent(): string;
}
