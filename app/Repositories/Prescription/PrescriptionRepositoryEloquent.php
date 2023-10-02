<?php

namespace App\Repositories\Prescription;
use App\Repositories\BaseRepository;

/**
 * Class PrescriptionRepositoryEloquent.
 *
 * @package App\Repositories\Prescription;
 */
class PrescriptionRepositoryEloquent extends BaseRepository implements PrescriptionRepository
{
  public function getModel()
  {
      return \App\Models\Prescription::class;
  }

  public function getPrescriptions($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->where('is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%');
        });
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
   }
}
