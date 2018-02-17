<?php

namespace Ivory\Tests\Serializer\Benchmark;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class JmsBenchmark extends AbstractBenchmark
{

    /**
     * @const string
     */
    protected const NAME = 'JMS';

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->serializer = SerializerBuilder::create()
            ->setCacheDir(__DIR__.'/../cache/Jms')
            ->build();
    }

    /**
     * {@inheritdoc}
     */
    public function execute($data)
    {
        return $this->serializer->serialize(
            $data,
            $this->getFormat()
        );
    }
}
