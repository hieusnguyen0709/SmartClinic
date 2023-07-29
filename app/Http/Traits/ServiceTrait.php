<?php

namespace App\Http\Traits;

use Auth;
use Illuminate\Support\Facades\Storage;
use SoareCostin\FileVault\Facades\FileVault;

trait ServiceTrait {
    private function getListSelect($list, $id = '')
    {
        $response = "<option value=''>Select</option>";
        
        foreach ($list as $item) {
            if (!empty($id) && $id == $item['id']) {
                $select = 'selected';
            } else {
                $select = '';
            }
            $response .= "<option value='" . $item['id'] . "' " . $select . ">" . $item['name'] . "</option>";
        }
        return $response;
    }

    private function getSmallByMajorId($majors, $smalls)
    {
        $result = [];
        foreach ($majors as $major) {
            foreach ($smalls as $small) {
                if ($small['major_id'] == $major['id']) {
                    $result[$major['id']][] = $small;
                }
            }
        }
        return $result;
    }

    public function uploadFile($file, $path, $isCrypt = false)
    {
        $fileName = Auth::user()->id . time() . '_' . $file->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            $path,
            $file,
            $fileName
        );
        if ($isCrypt) {
            FileVault::encrypt($path . $fileName);
            return $fileName . '.enc';
        }
        return $fileName;
    }

    public function deleteFile($path)
    {
        Storage::delete($path);
    }
    
    public static function replaceValueVariable($str, array $values)
    {
        foreach ($values as $key => $value) {
            if ($key == '[[url]]') {
                $str = str_replace($key, $value['text'], $str);
                $str = str_replace($key, $value['link'], $str);
            } else {
                $str = str_replace($key, $value, $str);
            }
        }

        return $str;
    }

    public function writeActivity($data, $repoObject)
    {
        return $repoObject->create($data);
    }
}