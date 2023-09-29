<?php

namespace App\Repositories\Category;
use App\Repositories\BaseRepository;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package App\Repositories\Category;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
  public function getModel()
  {
      return \App\Models\Category::class;
  }

  public function getCategories($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->where('is_delete', 0)
    ->when(!empty($search), function ($query1) use ($search) {
        $query1->where(function ($query1)  use ($search) {
            $query1->where('name', 'like', '%' . $search . '%')
            ->orwhereHas('user', function($query2) use ($search) {
              $query2->where('name', 'like', '%' . $search . '%');
          });
        });
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
  }

  public function getCategoryParent()
  {
    return $this->model->where('is_delete', 0)->where('parent_id', 0)->get();
  }
}
