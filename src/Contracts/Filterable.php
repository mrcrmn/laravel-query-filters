<?php

namespace Mrcrmn\QueryFilters\Contracts;

interface Filterable
{
    /**
     * Gets the filters that should be applied for this model.
     *
     * @return \Mrcrmn\QueryFilters\AbstractFilter[]
     */
    public function getFilters();
}
