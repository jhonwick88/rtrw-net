<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;
use Image;
use Illuminate\Support\Facades\Storage;

trait UploadFileHelper
{
    
    /**
    * upload file img
    * @param mixed $path
    * @param mixed $fileName
    * @param Request $request
    */
    public function uploadImg($path, $fileName, $request, $width = null, $height = null)
    {
        if (!$path) {
            return false;
        }

        // dynamic make path if not exist
        if (!file_exists($path)) {
            $paths = strpos($path, '/') !== false ? explode('/', $path) : [];
            $fullPath = public_path();
            foreach ($paths as $splitPath) {
                $currentPath = $fullPath.'/'.$splitPath;
                if (!file_exists($currentPath)) {
                    mkdir($currentPath);
                }
                $fullPath .= '/'.$splitPath;
            }
        }
        
        try {
            $dt = Carbon::parse(Carbon::Now());
            $timeStamp = $dt->timestamp;
            $destinationPath = public_path() . '/' .$path;
            $file = $request->file($fileName);
            \Log::info('------ Data Image ------ '.$file);
            $extension = $request->file($fileName)->getClientOriginalExtension();
            $originalName = $request->file($fileName)->getClientOriginalName();
            $fileName = $timeStamp . '__' . rand() . '.' . $extension;
            $img = Image::make($file->getRealPath());
                if ($file->getClientOriginalExtension() == 'gif') {
                    copy($file->getRealPath(), $destinationPath.'/'.$fileName);
                }
                else {
                    $newWidth = $width != null ? $width : $img->width();
                    $newHeight = $height != null ? $height : $img->height();
                    $img->resize($newWidth, $newHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fileName);
                }
           
            return collect([
                'status' => 'success',
                'name' => $fileName,
                'fileName' => $originalName
            ]);
        } catch (Exception $e) {
            \Log::info('------ Upload Error ------');
            \Log::info('error: '.$e->getMessage());
            \Log::info('------ Upload Error ------');
            return $e;
        }
    }

    /**
    * multiple upload file img
    * @param mixed $path
    * @param mixed $fileName
    * @param Request $request
    */
    public function multiUploadImg($path, $fileName, $request)
    {
        if (!$path) {
            return false;
        }

        // dynamic make path if not exist
        if (!file_exists($path)) {
            $paths = strpos($path, '/') !== false ? explode('/', $path) : [];
            $fullPath = public_path();
            foreach ($paths as $splitPath) {
                $currentPath = $fullPath.'/'.$splitPath;
                if (!file_exists($currentPath)) {
                    mkdir($currentPath);
                }
                $fullPath .= '/'.$splitPath;
            }
        }
        
        try {
            $dt = Carbon::parse(Carbon::Now());
            $timeStamp = $dt->timestamp;
            $destinationPath = public_path() . '/' .$path;
            $files = $request->file($fileName);
            $listFileName = [];
            $listOriginalName = [];
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $originalName = $file->getClientOriginalName();
                $fileName = $timeStamp . '__' . rand() . '.' . $extension;
                $img = Image::make($file->getRealPath());
                $img->resize(700, 700, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$fileName);
                $listFileName []= $fileName;
                $listOriginalName []= $originalName;
            }
            return collect([
                'status' => 'success',
                'name' => $listFileName,
                'fileName' => $listOriginalName
            ]);
        } catch (Exception $e) {
            \Log::info('------ Upload Error ------');
            \Log::info('error: '.$e->getMessage());
            \Log::info('------ Upload Error ------');
            return $e;
        }
    }

    /**
    * upload file
    * @param mixed $path
    * @param mixed $fileName
    * @param Request $request
    */
    public function uploadFile($path, $fileName, $request)
    {
        if (!$path) {
            return false;
        }
        
        try {
            $dt = Carbon::parse(Carbon::Now());
            $timeStamp = $dt->timestamp;
            $file = $request->file($fileName);
            $extension = $request->file($fileName)->getClientOriginalExtension();
            $originalName = $request->file($fileName)->getClientOriginalName();
            $fileName = $timeStamp . '__' . rand() . '.' . $extension;
            Storage::putFileAs($path, $file, $fileName);
            return collect([
                'status' => 'success',
                'name' => $fileName,
                'fileName' => $originalName
            ]);
        } catch (Exception $e) {
            \Log::info('------ Upload Error ------');
            \Log::info('error: '.$e->getMessage());
            \Log::info('------ Upload Error ------');
            return $e;
        }
    }

    /**
    * delete img if exist
    * @param Branch $branch
    */
    public function deleteImg($path, $fileName)
    {
        $directoryImg = public_path().'/'.$path;

        // remove img first if exist
        if (!is_null($fileName) && $fileName != '') {
            $image = explode('/', $fileName);
            $image = end($image);
            $image = $directoryImg.'/'.$image;
            if (file_exists($image)) {
                unlink($image);
            }
        }
    }
}
