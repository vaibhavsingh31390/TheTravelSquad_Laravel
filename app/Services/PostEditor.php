<?php

namespace App\Services;

use App\Http\Requests\UploadEditorImageRequest;

class PostEditor
{
    public function upload_Image(UploadEditorImageRequest $request)
    {
        $path = $request->file('image')->store('content-images/'.auth()->id(), 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
        ]);
    }
}
