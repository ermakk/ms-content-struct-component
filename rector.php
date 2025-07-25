<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);

    $rectorConfig->skip([
        __DIR__ . '/resources',
        __DIR__ . '/tests',
        ExplicitBoolCompareRector::class,
        FirstClassCallableRector::class,

    ]);

    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();
    $rectorConfig->removeUnusedImports();

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
    ]);
};
