<?php

namespace App\Http\Controllers;

use App\File as FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Hashids\Hashids;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'image' => 'The Files must be an image.',
            'max' => 'The :attribute must be 5M.',
        ];
        $validator = Validator::make($request->all(), [
            'files.0' => 'image|max:5000',
        ], $messages);
        $files = $request->file('files');

        if ($validator->fails()) {
            $result = [
                'success' => false,
                'filename' => $files[0]->getClientOriginalName(),
                'errorMessage' => $validator->errors()->all()
            ];

            return response()->json($result);
        }

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $fileName = sha1($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                $fileMD5 = md5_file($file);
                $fileModel = FileModel::where('md5', $fileMD5)->first();

                if ($fileModel) {
                    $isDuplicate = 1;
                } else {
                    $isDuplicate = 0;
                    $fileModel = FileModel::create([
                        'name' => $fileName,
                        'original_name' => $file->getClientOriginalName(),
                        'type' => $file->getClientMimeType(),
                        'size' => $file->getClientSize(),
                        'md5' => md5_file($file)
                    ]);

                    $path = 'uploads/' . date('Y') . '/' . date('m') . '/';
                    File::makeDirectory($path, 0775, true);
                    $hashids = new Hashids('abc123xyz', '16');
                    $hashId = $hashids->encode($fileModel->id);
                    $fileModel->hash_id = $hashId;
                    $fileModel->path = $path . $fileName;
                    $fileModel->save();

                    // create an image manager instance with favored driver
                    $manager = new ImageManager(array('driver' => 'gd'));

                    // create a new Image instance for inserting
                    $manager->make($file)
                        ->resize(760, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . $fileName);

                    // Thumbnail
                    $manager->make($file)->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . 'thumbnails_' . $fileName);
                }

                $result = [
                    'success' => true,
                    'isDuplicate' => $isDuplicate,
                    'filename' => $fileModel->original_name,
                    'directUrl' => url('h/' . $fileModel->hash_id),
                    'downloadUrl' => url('d/' . $fileModel->hash_id),
                    'thumbnailUrl' => url('t/' . $fileModel->hash_id),
                    'tdst' => url($fileModel->path),
                    'viewUrl' => url('v/' . $fileModel->hash_id),
                    'bbFullUrl' => '[img]' . url($fileModel->path) . '[/img]'
                ];

                return response()->json($result);
            }
        } else {
            $result = [
                'success' => false,
                'errorMessage' => 'Please select files.'
            ];

            return response()->json($result);
        }
    }

    public function viewHash($hashId)
    {
        $file = FileModel::where('hash_id', $hashId)->first();

        if (!$file) {
            abort(404);
        }

        return response(file_get_contents($file->path), 200, [
            'Content-Type' => $file->type,
            'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
        ]);
    }

    public function viewThumbnailHash($hashId)
    {
        $file = FileModel::where('hash_id', $hashId)->first();

        if (!$file) {
            abort(404);
        }

        return response(file_get_contents($file->thumbnail_path), 200, [
            'Content-Type' => $file->type,
            'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
        ]);
    }

    public function downloadHash($hashId)
    {
        $file = FileModel::where('hash_id', $hashId)->first();

        if (!$file) {
            abort(404);
        }

        return response(file_get_contents($file->path), 200, [
            'Content-Type' => $file->type,
            'Content-Disposition' => 'attachment; filename="' . $file->original_name . '"',
        ]);
    }

    public function delete($hashId)
    {
        $file = FileModel::where('hash_id', $hashId)->first();

        if (!$file) {
            return response()->json([
                'success' => false,
                'error_message' => '404 File Not Found'
            ]);
        }

        $file->delete();

        if (File::exists($file->path)) {
            File::delete($file->path);
        }

        if (File::exists($file->thumbnail_path)) {
            File::delete($file->thumbnail_path);
        }

        return response()->json([
            'success' => true
        ]);
    }
}