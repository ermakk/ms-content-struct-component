<?php
namespace Ermakk\CSComponent\Parsers;

use Ermakk\CSComponent\Components\Structure\StructureItem;
use Ermakk\CSComponent\Components\Structure\StructureItems;
use Ermakk\CSComponent\Contracts\ContentContract;
use \Ermakk\CSComponent\Contracts\StructureParserContract;
class HtmlParser implements StructureParserContract
{
    protected ?StructureItems $items = null;
    protected string $htmlContent = '';
    protected string $newHtmlContent = '';

    public function __construct(
        protected ContentContract $content
    )
    {
        $this->htmlContent = $this->content->getHtmlContent();
        $this->items = $this->parse();
        $this->newHtmlContent = $this->generateHtmlWithAnchors();

    }

    /**
     * @return StructureItems Структурированный набор заголовков
     */
    public function getItems(): StructureItems
    {
        return $this->items ?? new StructureItems();
    }

    /**
     * @return string Отформатированная строка HTML
     */
    public function getNewHtml(): string
    {
        return $this->newHtmlContent;
    }

    private function parse(): ?StructureItems
    {
        preg_match_all('/<h([1-6])(?:\sid="([^"]+)")?\s*(?:\sdata-structure-icon="([^"]+)")?\s*>(.*?)<\/h\1>/i', $this->htmlContent, $matches);

        if (empty($matches[0])) {
            return null;
        }

        $structure = new StructureItems();;
        foreach (array_keys($matches[0]) as $index) {
            $level = intval($matches[1][$index]);
            $id = strlen($matches[2][$index]) > 0 ? $matches[2][$index] : null; // Захватываем ручной идентификатор, если он есть
            $icon = $matches[3][$index];
            $title = trim(strip_tags($matches[4][$index]));
            $this->addHeadingToStructure($structure, $level, $title, $id, $icon);
        }
        return $structure;
    }

    private function addHeadingToStructure(
        &$structure,
       int $level,
       string $title,
       ?string $id = null,
       ?string $icon = null
    ): void
    {
        // Если структура пустая, добавляем первый заголовок
        if ($structure->isEmpty()) {
            $structure->append(new StructureItem($title, $level, $id));
            return;
        }

        // Начнем с самого верхнего элемента
        $currentNode = $structure->last();

        // Пытаемся углубиться в структуру, пока не найдем подходящее место
        while ($currentNode !== null && $currentNode->hasChildren() && $currentNode->level() < $level - 1) {
            $currentNode = $currentNode->children()->last();
        }

        // Корректируем размещение нового заголовка
        if ($currentNode !== null && $currentNode->level() === $level - 1) {
            if (!$currentNode->hasChildren()) {
                $currentNode->children(new StructureItems());
            }
            $currentNode->children()->append(new StructureItem($title, $level, $id, $icon));
        } else {
            $structure->append(new StructureItem($title, $level, $id, $icon));
        }
    }


    /**
     * @return string генерация HTML с якорями
     */
    public function generateHtmlWithAnchors(): string
    {
        // Далее применяем разметку Markdown с добавлением атрибута id к заголовкам
        $htmlContent = $this->htmlContent;
        if (!$this->items instanceof StructureItems) {
            return $htmlContent;
        }
        // Массив счётчиков для заголовков разного уровня
        $counters = array_fill(0, 6, 0); // Максимум 6 уровней (H1-H6)

        foreach ($this->items as $heading) {
            $this->updateHTMLForHeading($htmlContent, $heading, $counters);
        }

        return $htmlContent;
    }

    private function updateHTMLForHeading(string &$htmlContent, StructureItem &$heading, array &$counters): void {
        // если не существует идентификатора генерируем его и подставляем в разметку
        if ($heading->id() === '') {
            $counters[$heading->level()]++;
            $pathComponents = [];
            for ($i = 0; $i <= $heading->level()-1; $i++) {
                $pathComponents[] = $counters[$i+1];// уровень начинается с первого, а не с нулевого, поэтому +1
            }
            $finalId = 'heading-' . implode('-', $pathComponents);
            $heading->setId($finalId);
            // составляем паттерн для подстановки идентификатора
            $oldTitlePattern = '/<h' . $heading->level() . '\s*(?:id="[^"]+")?\s*>'
                . preg_quote($heading->title(), '/')
                . '<\/h' . $heading->level() . '>/';

            // Шаблон нового заголовка
            $newTitle = '<h' . $heading->level() . ' id="' . $heading->id() . '">' . $heading->title() . '</h' . $heading->level() . '>';

            // Выполняем замену
            $htmlContent = preg_replace($oldTitlePattern, $newTitle, $htmlContent);

        }

        // Обрабатываем вложенные заголовки
        if ($heading->hasChildren()) {
            foreach ($heading->children() as $child) {
                $this->updateHTMLForHeading($htmlContent, $child, $counters);
            }
        }
    }
}
