<?php

namespace App\Libraries;


class UploadVideo
{
    /**
     * Uploads Paths
     */
    const UPLOADS_PATH = __DIR__ . '/../../public/uploads/';
    const Ads_IMAGES_PATH = self::UPLOADS_PATH . 'ads/';


    /**
     * Get Upload Path By Type
     * @param $type
     * @return mixed
     */
    public static function getPathByType($type){
        $paths = [
            'ads' => self::Ads_IMAGES_PATH,
        ];
        return $paths[$type];
    }

    /**
     * Upload Image By Type
     * @param $type
     * @param $image
     * @return string
     */
    public static function upload($type, $image)
    {
        $extension = $image->getClientOriginalExtension();
        $destinationPath = self::getPathByType($type) ;
        $imageName = time() . rand() .'.' . $extension;
        $image->move($destinationPath,$imageName);
        return $imageName;
    }


    public static function  fullUrl($image,$type)
    {
        $result='uploads/'.$type.'/'.$image;
        return $result;
    }

}
