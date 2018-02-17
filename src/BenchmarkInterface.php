<?php

namespace Ivory\Tests\Serializer\Benchmark;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface BenchmarkInterface
{
    public function setUp();

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param mixed $data
     */
    public function execute($data);
}
