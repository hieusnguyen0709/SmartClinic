<?php

namespace App\Repositories\Medicine;
use App\Repositories\BaseRepository;

/**
 * Class MedicineRepositoryEloquent.
 *
 * @package App\Repositories\Medicine;
 */
class MedicineRepositoryEloquent extends BaseRepository implements MedicineRepository
{
  public function getModel()
  {
      return \App\Models\Medicine::class;
  }

  public function getMedicines($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->where('is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('instruction', 'like', '%' . $search . '%');
        });
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
   }
}
