<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller
{
    public function uploadChunk(Request $request)
    {
        if(Gate::allows('create', Teacher::class)){
            $file = $request->file('file');
            $chunkNumber = $request->input('chunkNumber');
            $totalChunks = $request->input('totalChunks');
            $fileName = $request->input('fileName');

            // The path where you want to store the temporary file chunks
            //$tempFilePath = storage_path('app/public/temp/');
            $tempFileName = "{$fileName}_{$chunkNumber}";

            $file->storeAs('public/temp/', $tempFileName);

            return response()->json(['message' => 'Chunk uploaded successfully.']);
        }
        
    }
    public function mergeChunks(Request $request)
    {
        $fileName = $request->input('fileName');
        $totalChunks = $request->input('totalChunks');

        // The path where you want to store the final merged file
        $finalFilePath = storage_path('app/public/videos/');
        $finalFileName = time(). '_' .$fileName ;
        //$uniqueFileName = $fileName . '_' . time();
        $finalFile = fopen($finalFilePath . $finalFileName, 'ab');

        for ($i = 1; $i <= $totalChunks; $i++) {
            $chunk = fopen(storage_path('app/public/temp/') . "{$fileName}_{$i}", 'rb');
            stream_copy_to_stream($chunk, $finalFile);
            fclose($chunk);
            unlink(storage_path('app/public/temp/') . "{$fileName}_{$i}");
        }

        fclose($finalFile);

        $video = new Video();
        //$video->name = $fileName;
        $video->video_url = 'Videos/' . $finalFileName;
        //$video->size = filesize($finalFilePath . $finalFileName);
        $video->save();

        return response()->json(['message' => 'File merged successfully.', 'id' => $video->id]);
    }
}
