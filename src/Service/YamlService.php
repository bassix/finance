<?php
declare(strict_types=1);

namespace Bassix\Finance\Service;

use Bassix\Finance\Exceptions\FileNotFoundException;
use Symfony\Component\Yaml\Parser as YamlParser;

class YamlService
{
    public static function getFromFile($file)
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException("File \"{$file}\" not found!");
        }

        return (new YamlParser())->parse(file_get_contents($file));
    }
}
