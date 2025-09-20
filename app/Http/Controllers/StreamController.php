<?php

namespace App\Http\Controllers;

use App\Http\Requests\StreamRequest;
use App\Models\Stream;
use App\Models\StreamType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        if ($request->has(['type', 'sort'])) {
            session([
                'stream_filters.type' => $request->type,
                'stream_filters.sort' => $request->sort,
            ]);
        }

        $type = $request->type ?? session('stream_filters.type');
        $sort = $request->sort ?? session('stream_filters.sort');

        $query = Stream::with('streamType')->where('user_id', auth()->id());

        if ($type) {
            $query->where('type', $type);
        }

        if ($sort) {
            switch ($sort) {
                case 'title_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'expiration_asc':
                    $query->orderBy('date_expiration', 'asc');
                    break;
                case 'expiration_desc':
                    $query->orderBy('date_expiration', 'desc');
                    break;
            }
        } else {
            $query->latest();
        }

        $streams = $query->paginate(10);

        return view('streams.index', compact('streams', 'type', 'sort'));
    }


    public function create()
    {
        $types = StreamType::all();
        return view('streams.create', compact('types'));
    }

    public function store(StreamRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Stream::create($data);
        return redirect()->route('streams.index');
    }

    public function edit(Stream $stream)
    {
        $this->authorize('update', $stream);
        $types = StreamType::all();
        return view('streams.edit', compact('stream', 'types'));
    }

    public function update(StreamRequest $request, Stream $stream)
    {
        $this->authorize('update', $stream);
        $stream->update($request->validated());
        return redirect()->route('streams.index');
    }

    public function destroy(Stream $stream)
    {
        $this->authorize('delete', $stream);
        $stream->delete();
        return redirect()->route('streams.index');
    }
}
