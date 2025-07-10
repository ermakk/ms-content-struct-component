# MoonShine content parse to structure menu component

### Установка

```shell
composer require ermakk/ms-cs-component
```
Добавьте провайдер в ваш `config/app.php` 

```php

'providers' => ServiceProvider::defaultProviders()->merge([

...

        \Ermakk\CSComponent\Providers\CSComponentServiceProvider::class
        
...

])->toArray(),

```

### Использование:

Для вывода оглавления используется компонент Menu.
Для инициализации обязателен один параметр - content
В качестве контета в меню передается класс реализующий интерфейс ContentContract
Задача этого класса - преобразование содержимого из необходимой вам разметки в HTML
для дальнейшего парсинга заголовков.

Вы можете создавать свои классы контента для вашей разметки, либо использовать сущесвтующие:
- `\Ermakk\CSComponent\Converters\MarkdownConverter` 
(Преобразует markdown разметку в html для дальнейшей работы парсера)
- `\Ermakk\CSComponent\Converters\Html` 
(не конвертирует контент, но даже если у вас контент был в html разметке - 
необходимо передавать его в меню именно через класс)

В качестве второго аргумента можно класс парсера, для того чтобы переопределить поведение,
разметку, правила генерации идентификаторов и т. п.

По умолчанию используется `Ermakk\CSComponent\Parsers\HTMLParser`

```php
use Ermakk\CSComponent\Components\StructureMenu\Menu;
use \Ermakk\CSComponent\Converters\MarkdownConverter;

Menu::make(MarkdownConverter::make($content))
```

По умолчанию все якорные ссылки генерируются исходя из текущей, могут появится ситуации,
когда будет необходимость вручную задать базу для ссылки. Для этого можно воспользоваться методом
`setRoute(?Closure $route)` у объекта Menu


```php
use Ermakk\CSComponent\Components\StructureMenu\Menu;
use \Ermakk\CSComponent\Converters\MarkdownConverter;

// в таком случае все что вернет замыкание, будет использовано в качестве якорной ссылки
// обратите внимание, что в таком случае вам нужно будет вручную добавить '#'.$item->id()
// к возвращаемому замыканием значению

Menu::make(MarkdownConverter::make($content))->setRoute(fn(StructureItem $item) => 'Ваш роут'.'#'.$item->id());
```

#### Методы
 - setTitle(string $title) - устанавливает заголовок меню

 - setPlaceholder(string $placeholder) - устанавливает сообщение, которое оторажается, когда нет содержимого

 - simpleMode(bool $condition) - меняет режим отображения
   - true - простой режим, отображает только набор пунктов
   - false - стандартный режим, используемый по умолчанию, отображает заголовок меню и пункты в контейнере .box