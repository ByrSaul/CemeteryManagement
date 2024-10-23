<?php

namespace CemeteryManagement\Contracts\Repositories;

use CemeteryManagement\ValueObjects\Data\FiltersInfo;
use CemeteryManagement\ValueObjects\Data\JoinInfo;
use CemeteryManagement\ValueObjects\Data\SummaryInfo;

/**
 * Contract for repositories calculate fields
 *
 * @package Proaktiv
 */
interface SummarizableRepository
{
    /**
     * Retrieves summary info from the system.
     *
     * @param   string        $sumField     Summary Field
     * @param   FiltersInfo   $filtersInfo  Filters Information
     * @param   JoinInfo      $joinInfo     Join information condition
     * @param   string        $groupBy      Field Group By
     *
     * @return SummaryInfo
     */
    public function getSummaryInfo(
        string $sumField,
        FiltersInfo $filtersInfo = null,
        JoinInfo $joinInfo = null,
        string $groupBy = ""
    ): SummaryInfo;
}
