<?php

declare (strict_types=1);
namespace RectorPrefix20220128;

use Rector\Composer\Rector\ChangePackageVersionComposerRector;
use Rector\Composer\Rector\RemovePackageComposerRector;
use Rector\Composer\ValueObject\PackageAndVersion;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/../config.php');
    $services = $containerConfigurator->services();
    $services->set(\Rector\Composer\Rector\RemovePackageComposerRector::class)->configure(['typo3/cms-rsaauth', 'typo3/cms', 'typo3/cms-context-help', 'typo3/cms-info-pagetsconfig', 'typo3/cms-wizard-crpages', 'typo3/cms-wizard-sortpages', 'typo3/cms-cshmanual', 'typo3/cms-func', 'typo3/cms-documentation', 'dmitryd/typo3-realurl', 'typo3-ter/typo3-realurl']);
    $services->set(\Rector\Composer\Rector\ChangePackageVersionComposerRector::class)->configure([new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-about', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-adminpanel', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-backend', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-belog', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-beuser', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-core', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-dashboard', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-extbase', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-extensionmanager', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-felogin', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-filelist', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-filemetadata', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-fluid', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-fluid-styled-content', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-form', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-frontend', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-impexp', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-indexed-search', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-info', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-install', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-linkvalidator', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-lowlevel', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-opendocs', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-recordlist', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-recycler', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-redirects', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-reports', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-rte-ckeditor', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-scheduler', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-seo', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-setup', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-sys-note', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-t3editor', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-tstemplate', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-viewpage', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3/cms-workspaces', '^10.4'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3-console/composer-auto-commands', '^0.4.0'), new \Rector\Composer\ValueObject\PackageAndVersion('helhum/typo3-console', '^6.0'), new \Rector\Composer\ValueObject\PackageAndVersion('helhum/dotenv-connector', '^3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('helhum/typo3-secure-web', '^0.3.0'), new \Rector\Composer\ValueObject\PackageAndVersion('typo3-console/composer-typo3-auto-install', '^0.4.0')]);
};
