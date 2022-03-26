<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->path = 'public/attachments';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        if($result = $attachment->delete()){
            Storage::delete($attachment->path);
        }

        return $result;
    }

    public function storeAttachment(Model $model, $files)
    {
        foreach ($files as $index => $file) {
            $result = $file->store($this->path.'/'.date('Y').'/'.date('m').'/'.date('d'));
            $fileInfo['path'] = $result;
            $fileInfo['name'] = $file->getClientOriginalName();
            $fileInfo['size'] = $file->getSize();
            $fileInfo['mineType'] = $file->getClientMimeType();
            if([$width, $height] = getimagesize($file)){
                $fileInfo['width'] = $width;
                $fileInfo['height'] = $height;
            }
            $model->attachments()->create($fileInfo);
        }
    }
}
