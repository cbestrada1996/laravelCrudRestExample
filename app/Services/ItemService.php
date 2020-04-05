<?php

namespace App\Services;

use App\Http\Requests\ItemRequest;
use App\Http\Resources\Item as ResourceItem;
use App\Http\Resources\ItemCollection as ResourceItemCollection;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Services\Interfaces\ItemServiceInterface;
use Illuminate\Http\JsonResponse;

class ItemService implements ItemServiceInterface
{

    private $itemRepository;
    private const ITEM_IMAGE_STORE = "items/images";

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function all(): JsonResponse
    {
        $items = $this->itemRepository->all();

        return response()->json(new ResourceItemCollection($items), 200); 
    }

    public function find(int $id): JsonResponse
    {
        $item = $this->itemRepository->find($id);

        return response()->json(new ResourceItem($item), 200);
    }

    public function create(ItemRequest $request): JsonResponse
    {
        $path = $request->file("image")->store($this::ITEM_IMAGE_STORE, 'public');
        $params = $request->all();
        $params['image'] = $path;
        $item = $this->itemRepository->create($params);

        return response()->json(new ResourceItem($item), 200);
    }

    public function update(int $id, ItemRequest $request): JsonResponse
    {
        $params = $request->all();
        if($request->hasFile("image")){
            $path = $request->file("image")->store($this::ITEM_IMAGE_STORE, 'public');
            $params['image'] = $path;
        }
      
        $item = $this->itemRepository->update($id,$params);

        return response()->json(new ResourceItem($item), 200);
    }

    public function delete(int $id): JsonResponse
    {
        $item = $this->itemRepository->delete($id);

        return response()->json(new ResourceItem($item), 200);
    }
}
