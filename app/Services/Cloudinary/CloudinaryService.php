<?php
namespace App\Services\Cloudinary;

use Cloudinary;
use Cloudinary\Api;

use App\Services\CDN\CdnInterface;

class CloudinaryService implements CdnInterface
{
    private $cloudName;

    private $apiKey;

    private $apiSecret;

    public function __construct($apiKey, $apiSecret, $cloudName)
    {
        $this->apiSecret = $apiSecret;

        $this->apiKey = $apiKey;

        $this->cloudName = $cloudName;
    }

    public function delete($public_ids)
    {
        Cloudinary::config([
            "cloud_name" => $this->cloudName,
            "api_key" => $this->apiKey,
            "api_secret" => $this->apiSecret,
            "secure" => true
        ]);

        return  (new Api())->delete_resources($public_ids);
    }
}