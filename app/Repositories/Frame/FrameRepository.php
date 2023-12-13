<?php

namespace App\Repositories\Frame;
use App\Repositories\RepositoryInterface;

/**
 * Interface FrameRepository.
 *
 * @package namespace App\Repositories;
 */
interface FrameRepository extends RepositoryInterface
{
    public function getFrames($search = null, $numPerPage = null, $sortColumn = null, $sortType = null);
    public function getFrameByIds($ids = []) ;
}
