<?php

namespace RectorPrefix20211005;

if (\class_exists('tx_scheduler_Task')) {
    return;
}
class tx_scheduler_Task
{
}
\class_alias('tx_scheduler_Task', 'tx_scheduler_Task', \false);
