<?php

namespace App\Frontend\Video\Controller;

use App\Client\Video\Client\ClientInterface;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Symfony\Component\HttpFoundation\Request;

class VideoController
{
    /*
    public function __construct(private readonly ClientInterface $client)
    {
    }
    */

    /**
     * @param Request $request
     *
     * @return VideoTransfer
     */
    public function getVideo(Request $request): VideoTransfer
    {
       // $videoGet = $request->get('video');

       // return $this->client->getVideo($videoGet);

        $video = new VideoTransfer();

        $video->setName('Sample video');
        $video->setCreatedAt(new \DateTime('11.08.1989'));
        $video->setId($request->get('video_id'));
        $video->setUrl('https://devstreaming-cdn.apple.com/videos/streaming/examples/img_bipbop_adv_example_fmp4/master.m3u8');

        return $video;
    }
}