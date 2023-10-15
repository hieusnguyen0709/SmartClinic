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
    public function getCategories($search = null, $numPerPage = null, $sortColumn = null, $sortType = null);
    public function getCategoryParent();
}
