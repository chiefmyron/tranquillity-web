<?php declare(strict_types=1);
namespace Tranquillity\Utility\Profiler\DataCollector;

interface LateDataCollectorInterface extends DataCollectorInterface {
    /**
     * Performs very last-minute data collection
     */
    public function lateCollect();
}