<?php

namespace App\Repositories\Category;
use App\Repositories\RepositoryInterface;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories;
 */
interface CategoryRepository extends RepositoryInterface
{
    public function getCategories($search, $numPerPage, $sortColumn, $sortType);
    public function getCategoryParent();
}
