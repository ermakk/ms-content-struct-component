<?php

namespace Ermakk\CSComponent\Contracts;



interface StructureParserContract
{

    /**
     * @return StructureItemsContract Структурированный набор заголовков
     */
    public function getItems(): StructureItemsContract;


    /**
     * @return string Отформатированная строка HTML
     */
    public function getNewHtml(): string;

    /**
     * @return string генерация HTML с якорями
     */
    public function generateHtmlWithAnchors(): string;

}
