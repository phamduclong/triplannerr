<?php

namespace App\Repositories\Backend\Tours;

interface ToursRepositoryInterface
{

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

}