<?php
namespace App\Repositories;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ItemRepository implements ItemRepositoryInterface 
{
    public function all(): Collection 
    {
        return Item::all();
    }

    public function find(int $id): Item
    {
        $item = Item::find($id);

        if($item)
        {
            return $item;
        }

        throw new HttpResponseException(
            response()->json([
                'error' => [
                    "code" => JsonResponse::HTTP_NOT_FOUND,
                    "message" => "The item don't exist."
                ]
            ], JsonResponse::HTTP_NOT_FOUND)
        );
    }

    public function create(array $params): Item
    {
        return Item::create($params);
    }

    public function update(int $id, array $params): Item
    {
        $item = $this->find($id);

        if($params['image']){
            Storage::disk('public')->delete($item->image);
        }

        $item->update($params);

        return $item->refresh();
    }

    public function delete(int $id): Item
    {
        $item = Item::find($id);

        if($item->delete()){
            return $item;
        }

        throw new HttpResponseException(
            response()->json([
                'error' => [
                    "code" => JsonResponse::HTTP_NOT_FOUND,
                    "message" => "The item can't be deleted"
                ]
            ], JsonResponse::HTTP_NOT_FOUND)
        );
    }
}