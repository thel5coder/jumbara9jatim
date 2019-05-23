<?php
/**
 * Created by PhpStorm.
 * User: syaikhulhadi
 * Date: 2019-04-24
 * Time: 05:41
 */

namespace App\Repositories\Actions;


use App\Models\InformationModel;
use App\Repositories\Contracts\IInformationRepository;

class InformationRepository implements IInformationRepository
{

    public function create($input)
    {
        $information = new InformationModel();
        $information->slug = $input['slug'];
        $information->title = $input['title'];
        $information->content = $input['content'];
        $information->featured_image = $input['featuredImage'];
        $information->views_counter = 0;
        $information->created_at = date('Y-m-d H:i:s');

        return $information->save();
    }

    public function update($input)
    {
        $information = InformationModel::find($input['id']);
        $information->slug = $input['slug'];
        $information->title = $input['title'];
        $information->content = $input['content'];
        $information->featured_image = $input['featuredImage'];
        $information->updated_at = date('Y-m-d H:i:s');

        return $information->save();
    }

    public function delete($id)
    {
        return InformationModel::find($id)->delete();
    }

    public function read($id)
    {
        $information = InformationModel::find($id);

        return [
            'id'=>$information->id,
            'title'=>$information->title,
            'slug'=>$information->slug,
            'content'=>$information->content,
            'viewCounter'=>$information->views_counter,
            'featuredImage'=>$information->featured_image,
            'createdAt'=>$information->created_at->toDateString(),
            'updatedAt'=>$information->updated_at->toDateString()
        ];
    }

    public function showAll()
    {
        $informations = InformationModel::all();
        $data = [];

        foreach ($informations as $information){
            $data[]=[
                'id'=>$information->id,
                'title'=>$information->title,
                'slug'=>$information->slug,
                'content'=>$information->content,
                'viewCounter'=>$information->views_counter,
                'featuredImage'=>$information->featured_image,
                'createdAt'=>$information->created_at->toDateString(),
                'updatedAt'=>$information->updated_at->toDateString()
            ];
        }

        return $data;
    }

    public function pagination($searchPhrase = null)
    {
        // TODO: Implement pagination() method.
    }

    public function getBySlug($slug)
    {
        $information = InformationModel::where('slug','=',$slug)->first();

        return [
            'id'=>$information->id,
            'title'=>$information->title,
            'slug'=>$information->slug,
            'content'=>$information->content,
            'viewCounter'=>$information->views_counter,
            'featuredImage'=>$information->featured_image,
            'createdAt'=>$information->created_at->toDateString(),
            'updatedAt'=>$information->updated_at->toDateString()
        ];
    }


    public function existingCounter($slug)
    {
        return InformationModel::where('slug','=slug',$slug)->value('views_counter');
    }


    public function updateCounter($slug,$counter)
    {
        return InformationModel::where('slug','=',$slug)->update(['views_counter'=>($counter+1)]);
    }


}