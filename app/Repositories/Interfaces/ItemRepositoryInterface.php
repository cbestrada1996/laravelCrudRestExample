<?php
namespace App\Repositories\Interfaces;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

interface ItemRepositoryInterface 
{

    /**
     * Return all records from items table
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Return one item that match the id 
     *`
     * @param integer $id
     * @return Item
     */
    public function find(int $id): Item;

    /**
     * Create new record of Items
     * Return the item that was created
     *
     * @param array $request
     * @return Item
     */
    public function create(array $params): Item;

    /**
     * Update the record of item
     * Return the item that was updated
     * 
     * @param int $id
     * @param array $params
     * @return Item
     */
    public function update(int $id, array $params): Item;

    /**
     * Delete the record of the item
     * Return the deleted record
     *
     * @param integer $id
     * @return Item
     */
    public function delete(int $id): Item;
}