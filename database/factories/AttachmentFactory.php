<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attachment;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Attachment::class;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->filePath = storage_path("app/public/posts/tmp");
        if(!is_dir($this->filePath)){
            mkdir($this->filePath, 0777, true);
        }
    }

    public function definition()
    {
        $path = $this->faker->image($this->filePath, 1000, 1000);
        $filesystem = new Filesystem;
        $name = $filesystem->name( $path );
        $extension = $filesystem->extension( $path );
        $originalName = $name . '.' . $extension;
        $mimeType = $filesystem->mimeType( $path );
        $error = null;
        $file = new UploadedFile( $path, $originalName, $mimeType, $error, true );
        [$width, $height] = getimagesize($file);

        return [
            'path' => 'public/posts/tmp/'.$file->getClientOriginalName(),
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mineType' => $file->getClientMimeType(),
            'width' => $width,
            'height' => $height
        ];
    }
}
