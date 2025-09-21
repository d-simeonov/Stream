<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StreamRequest;
use App\Http\Resources\StreamResource;
use App\Models\Stream;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StreamApiController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Stream::query()->with('streamType');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'title_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'expiration_desc':
                    $query->orderBy('date_expiration', 'desc');
                    break;
                default:
                    $query->latest();
            }
        }

        return StreamResource::collection($query->paginate(10));
    }

    public function store(StreamRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $stream = Stream::create($data);
        return new StreamResource($stream);
    }

    public function show(Stream $stream)
    {
        $this->authorize('view', $stream);
        return new StreamResource($stream);
    }

    public function update(StreamRequest $request, Stream $stream)
    {
        $this->authorize('update', $stream);
        $stream->update($request->validated());
        return new StreamResource($stream);
    }

    public function destroy(Stream $stream)
    {
        $this->authorize('delete', $stream);
        $stream->delete();
        return response()->json(['message' => 'Stream deleted']);
    }
}
