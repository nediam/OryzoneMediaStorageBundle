<?php

namespace Oryzone\Bundle\MediaStorageBundle\Filesystem;

/*
 * This file is part of the Oryzone/MediaStorage package.
 *
 * (c) Luciano Mammino <lmammino@oryzone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code (Resources/meta/LICENSE).
 */

use League\Flysystem\MountManager,
    Oryzone\MediaStorage\Filesystem\FilesystemFactoryInterface,
    Oryzone\MediaStorage\Exception\InvalidArgumentException;

class MapFilesystemFactory implements FilesystemFactoryInterface
{

    /**
     * @var MountManager $map
     */
    protected $map;

    /**
     * Constructor
     *
     * @param MountManager $map
     */
    public function __construct(MountManager $map)
    {
        $this->map = $map;
    }

    /**
     * {@inheritDoc}
     */
    public function get($filesystemName)
    {
        try {
            return $this->map->getFilesystem($filesystemName);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException(sprintf('Cannot find a filesystem named "%s"', $filesystemName), 0, $e);
        }
    }
}
