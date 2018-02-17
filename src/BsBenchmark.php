<?php

namespace Ivory\Tests\Serializer\Benchmark;

use BetterSerializer\Builder;
use BetterSerializer\Common\SerializationType;
use BetterSerializer\Serializer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BsBenchmark extends AbstractBenchmark
{

    /**
     * @const string
     */
    protected const NAME = 'BetterSerializer';

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $builder = new Builder();

        if (extension_loaded('apcu') && ini_get('apc.enabled')) {
            $builder->enableApcuCache();
        } else {
            $builder->setCacheDir(dirname(__DIR__, 2) . '/cache/better-serializer');
        }

        $this->serializer = $builder->createSerializer();
    }

    /**
     * {@inheritdoc}
     */
    public function execute($data)
    {
        return $this->serializer->serialize(
            $data,
            SerializationType::byValue($this->getFormat())
        );
    }
}
