<?php

namespace App\Frontend\Video\Controller;

use App\Shared\Generated\DTO\Video\VideoCreateTransfer;
use App\Shared\Generated\DTO\Video\VideoTransfer;
use Micro\Plugin\Http\Exception\BadRequestException;
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
     *
     * @throws BadRequestException
     */
    public function createVideo(Request $request): VideoTransfer
    {
        $content = json_decode($request->getContent(), true);
        if(!$content) {
            throw new BadRequestException();
        }

        $videoCreateTransfer = new VideoCreateTransfer();
        $videoCreateTransfer->setFileId($content['file_id']);


    }

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
        $video->setUrl('https://cph-p2p-msl.akamaized.net/hls/live/2000341/test/master.m3u8');

        return $video;
    }
}