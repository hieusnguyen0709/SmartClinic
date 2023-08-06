<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get all
     * @return mixed
     */
    public function getAllRecordActive($column = '');

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Get one
     * @param $slug
     * @return mixed
     */
    public function findBySlugOrFail($slug);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
    public function lastRecord($column = '');
    public function firstRecord($column = '');
    public function updateMulti($ids, $attributes = []);
    public function updateByColumn($column, $value, $attributes = []);
}