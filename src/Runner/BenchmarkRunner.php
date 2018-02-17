<?php

namespace Ivory\Tests\Serializer\Benchmark\Runner;

use Ivory\Tests\Serializer\Benchmark\BenchmarkInterface;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResult;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResultInterface;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResults;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BenchmarkRunner
{
    /**
     * @param BenchmarkInterface $benchmark
     * @param int                $iteration
     * @param int                $horizontalComplexity
     * @param int                $verticalComplexity
     *
     * @return BenchmarkResultInterface
     */
    public function run(
        BenchmarkInterface $benchmark,
        $data,
        $iteration = 1
    ) {
        $results = [];
        $this->doRun($benchmark, $data);

        for ($i = 0; $i < $iteration; $i++) {
            $results[] = $this->doRun($benchmark, $data);
        }

        if ($iteration > 1) {
            return new BenchmarkResults($results);
        }

        return reset($results);
    }

    /**
     * @param BenchmarkInterface $benchmark
     *
     * @return BenchmarkResult
     */
    private function doRun(BenchmarkInterface $benchmark, $data)
    {
        $startTime = microtime(true);
        $benchmark->execute($data);
        $finishTime = microtime(true);

        return new BenchmarkResult($benchmark->getName(), $finishTime - $startTime);
    }
}
