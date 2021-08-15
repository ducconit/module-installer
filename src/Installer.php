<?php

namespace DNT\Composer\Modules;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;


if (!function_exists('finish')) {
    function finish($value, $cap)
    {
        $quoted = preg_quote($cap, '/');

        return preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
    }
}

class Installer extends LibraryInstaller
{
    public $packageType = 'module';

    private $dr = DIRECTORY_SEPARATOR;

    public function getInstallPath(PackageInterface $package)
    {
        $extra = $this->composer->getPackage()->getExtra();
        if (isset($extra['ducnt']) && isset($extra['ducnt']['module-dir'])) {
            $path = $extra['ducnt']['module-dir'];
        }
        $path = finish($path ?? $this->getPathDefault(), $this->dr);
        return $path . str_replace('/', '-', $package->getPrettyName());
    }

    public function supports($packageType)
    {
        return $this->packageType === $packageType;
    }

    private function getPathDefault()
    {
        return 'modules';
    }
}