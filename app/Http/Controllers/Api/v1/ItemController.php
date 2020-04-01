<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Services\Interfaces\ItemServiceInterface;

class ItemController extends Controller
{

    private $itemService;

    public function __construct(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    public function all()
    {
        return $this->itemService->all();
    }

    public function find(int $id)
    {
        return $this->itemService->find($id);
    }

    public function create(ItemRequest $request)
    {
        return $this->itemService->create($request);
    }

    public function update(ItemRequest $request, int $id)
    {
        return $this->itemService->update($id, $request);
    }

    public function delete(ItemRequest $request, int $id)
    {
        return $this->itemService->delete($id);
    }

}
