<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllRecordActive($column = '')
    {
        if (!empty($column)) {
            return $this->model->where('is_delete', 0)->orderBy($column, 'ASC')->get();
        }
        return $this->model->where('is_delete', 0)->get();
    }

    public function findBySlugOrFail($slug)
    {
        $result = $this->model->findBySlugOrFail($slug);

        return $result;
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateMulti($ids, $attributes = [])
    {
        return $this->model->whereIn('id', $ids)->update($attributes);
    }

    public function updateByColumn($column, $value, $attributes = [])
    {
        return $this->model->where($column, $value)->update($attributes);
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
    public function lastRecord($column = '')
    {
        if (empty($column)) {
            return $this->model->where('is_delete', 0)->orderBy('id', 'DESC')->first();
        } else {
            return $this->model->where('is_delete', 0)->orderBy($column, 'DESC')->first();
        }
        
    }

    public function firstRecord($column = '')
    {
        if (empty($column)) {
            return $this->model->where('is_delete', 0)->orderBy('id', 'ASC')->first();
        } else {
            return $this->model->where('is_delete', 0)->orderBy($column, 'ASC')->first();
        }
        
    }
}
