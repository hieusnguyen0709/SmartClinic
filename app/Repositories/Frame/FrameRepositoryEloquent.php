<?php

namespace App\Repositories\Frame;
use App\Repositories\BaseRepository;

/**
 * Class FrameRepositoryEloquent.
 *
 * @package App\Repositories\Frame;
 */
class FrameRepositoryEloquent extends BaseRepository implements FrameRepository
{
  public function getModel()
  {
      return \App\Models\Frame::class;
  }

  public function getFrames($search = null, $numPerPage = null, $sortColumn = null, $sortType = null)
  {
    return $this->model->where('is_delete', 0)
    ->when(!empty($search), function ($query) use ($search) {
        $query->where(function ($query)  use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    })
    ->orderBy($sortColumn, $sortType)
    ->paginate($numPerPage);
  }

  public function getFrameByIds($ids = []) 
  {
    return $this->model->where('is_delete', 0)->whereIn('id', $ids)->get();
  }
}
