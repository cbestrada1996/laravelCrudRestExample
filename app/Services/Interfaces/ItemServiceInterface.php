<?php
namespace App\Services\Interfaces;

use App\Http\Requests\ItemRequest;
use Illuminate\Http\JsonResponse;

interface ItemServiceInterface 
{

    /**
     * Return all records from items table
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse;

    /**
     * Return one item that match the id 
     *`
     * @param integer $id
     * @return JsonResponse
     * @throws HttpResponseException
     */
    public function find(int $id): JsonResponse;

    /**
     * Create new record of Items
     * Return the item that was created
     *
     * @param ItemRequest $request
     * @return JsonResponse
     */
    public function create(ItemRequest $request): JsonResponse;

    /**
     * Update the record of item
     * Return the item that was updated
     * 
     * @param int $id
     * @param ItemRequest $request
     * @return JsonResponse
     */
    public function update(int $id, ItemRequest $request): JsonResponse;

    /**
     * Delete the record of item
     * Return the delete item
     * 
     * @param integer $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse;
}