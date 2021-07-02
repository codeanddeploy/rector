<?php

declare (strict_types=1);
namespace Rector\Nette\FileProcessor;

use Rector\Core\Contract\Processor\FileProcessorInterface;
use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Configuration;
use Rector\Nette\Contract\Rector\NeonRectorInterface;
final class NeonFileProcessor implements \Rector\Core\Contract\Processor\FileProcessorInterface
{
    /**
     * @var mixed[]
     */
    private $neonRectors;
    /**
     * @param NeonRectorInterface[] $neonRectors
     */
    public function __construct(array $neonRectors)
    {
        $this->neonRectors = $neonRectors;
    }
    public function process(\Rector\Core\ValueObject\Application\File $file, \Rector\Core\ValueObject\Configuration $configuration) : void
    {
        $fileContent = $file->getFileContent();
        foreach ($this->neonRectors as $neonRector) {
            $fileContent = $neonRector->changeContent($fileContent);
        }
        $file->changeFileContent($fileContent);
    }
    public function supports(\Rector\Core\ValueObject\Application\File $file, \Rector\Core\ValueObject\Configuration $configuration) : bool
    {
        $fileInfo = $file->getSmartFileInfo();
        return $fileInfo->hasSuffixes($this->getSupportedFileExtensions());
    }
    /**
     * @return string[]
     */
    public function getSupportedFileExtensions() : array
    {
        return ['neon'];
    }
}
