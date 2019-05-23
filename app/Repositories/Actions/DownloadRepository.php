<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-24
 * Time: 09:16
 */

namespace App\Repositories\Actions;


use App\Models\DownloadModel;
use App\Repositories\Contracts\IDownloadRepository;

class DownloadRepository implements IDownloadRepository
{

    public function create($input)
    {
        $download = new DownloadModel();
        $download->slug = $input['slug'];
        $download->title = $input['title'];
        $download->download_file = $input['fileDownload'];
        $download->download_counter = 0;
        $download->created_at = date('Y-m-d H:i:s');

        return $download->save();
    }

    public function update($input)
    {
        $download = DownloadModel::find($input['id']);
        $download->slug = $input['slug'];
        $download->title = $input['title'];
        $download->download_file = $input['fileDownload'];
        $download->updated_at = date('Y-m-d H:i:s');

        return $download->save();
    }

    public function delete($id)
    {
        return DownloadModel::find($id)->delete();
    }

    public function read($id)
    {
        $download = DownloadModel::find($id);

        return [
            'id'=>$download->id,
            'slug'=>$download->slug,
            'title'=>$download->title,
            'fileDownload'=>$download->download_file,
            'downloadCounter'=>$download->download_counter
        ];
    }

    public function showAll()
    {
        $downloads = DownloadModel::all();
        $data = [];

        foreach ($downloads as $download){
            $data[]=[
                'id'=>$download->id,
                'slug'=>$download->slug,
                'title'=>$download->title,
                'fileDownload'=>$download->download_file,
                'downloadCounter'=>$download->download_counter
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function getDownloadBySlug($slug)
    {
        $download = DownloadModel::where('slug','=',$slug)->first();

        return [
            'id'=>$download->id,
            'slug'=>$download->slug,
            'title'=>$download->title,
            'fileDownload'=>$download->download_file,
            'downloadCounter'=>$download->download_counter
        ];
    }

    public function getExistingDownloadCount($slug)
    {
        return DownloadModel::where('slug','=',$slug)->value('download_counter');
    }

    public function updateDownloadCount($slug,$counter)
    {
       return DownloadModel::where('slug','=',$slug)->update(['download_counter'=>$counter]);
    }


}