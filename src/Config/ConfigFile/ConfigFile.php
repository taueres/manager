<?php

/*
 * This file is part of the Puli Repository Manager package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Puli\RepositoryManager\Config\ConfigFile;

use Puli\RepositoryManager\Config\Config;
use Puli\RepositoryManager\Config\DefaultConfig;

/**
 * A file storing configuration.
 *
 * @since  1.0
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ConfigFile
{
    /**
     * @var string|null
     */
    private $path;

    /**
     * @var Config
     */
    private $config;

    /**
     * Creates a new configuration file.
     *
     * @param string|null $path The path where the configuration file is stored
     *                          or `null` if this configuration is not stored on
     *                          the file system.
     *
     * @throws \InvalidArgumentException If the path is not a string or empty.
     */
    public function __construct($path = null)
    {
        if (!is_string($path) && null !== $path) {
            throw new \InvalidArgumentException(sprintf(
                'The path to the configuration file should be a string '.
                'or null. Got: %s',
                is_object($path) ? get_class($path) : gettype($path)
            ));
        }

        if ('' === $path) {
            throw new \InvalidArgumentException('The path to the configuration file should not be empty.');
        }

        // Inherit from default configuration
        $this->config = new Config(new DefaultConfig());
        $this->path = $path;
    }

    /**
     * Returns the path to the configuration file.
     *
     * @return string|null The path or `null` if this configuration is not
     *                     stored on the file system.
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the configuration stored in the file.
     *
     * @return Config The configuration.
     */
    public function getConfig()
    {
        return $this->config;
    }
}