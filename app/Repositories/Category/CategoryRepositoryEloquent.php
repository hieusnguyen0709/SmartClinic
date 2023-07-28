<?php

namespace App\Repositories\Category;

use App\Models\Category;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package App\Repositories\Category;
 */
class CategoryRepositoryEloquent implements CategoryRepository
{
    protected $model;

    public function __construct(Category $model)
    {
      $this->model = $model;
    }

    public function getAll()
    {
        $model = $this->model->get();
        return $model;
    }

}
