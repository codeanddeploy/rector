<?php

namespace RectorPrefix20210916\TYPO3\CMS\Core\Resource\Exception;

use Exception;
if (\class_exists('TYPO3\\CMS\\Core\\Resource\\Exception\\InvalidFileException')) {
    return;
}
class InvalidFileException extends \Exception
{
}
