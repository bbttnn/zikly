<?php

namespace App\Service;


use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{

    private $slugger;

    private  $imageDirectory;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->imageDirectory = "image/uploads/";
    }
    public function upload(UploadedFile $newFile, string $oldPath =""):?string
    {
        $originalFilename = pathinfo($newFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $finalFilename = "$safeFilename" . uniqid() . "." . $newFile->guessExtension();
        $newFile->move($this->imageDirectory, $finalFilename);
        $this->delete($oldPath);
        return  $finalFilename;
    }
    public function delete(string $oldPath):void
    {
        if(is_file($oldPath)){
            unlink($this->imageDirectory. $oldPath);
        }
    }

    
}
