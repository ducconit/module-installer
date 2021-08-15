<?php

namespace Ducnt\Composer\Packages;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;


class Installer extends LibraryInstaller
{
    public $packageType = 'ducnt-theme';

    public function getInstallPath(PackageInterface $package)
    {
        return 'resources/themes/' . $package->getPrettyName() ;
    }

    public function supports($packageType)
    {
        return $this->packageType === $packageType;
    }
}