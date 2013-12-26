<?php

namespace hu\szjani\sample\infrastructure\finder;

use hu\szjani\sample\finder\user\UserFinder;
use predaddy\presentation\Page;
use predaddy\presentation\Pageable;

class DbalUserFinder implements UserFinder
{
    /**
     * @param Pageable $pageable
     * @param string|null $filterName
     * @return Page
     */
    public function findAll(Pageable $pageable, $filterName = null)
    {
        // TODO: Implement findAll() method.
    }
}
