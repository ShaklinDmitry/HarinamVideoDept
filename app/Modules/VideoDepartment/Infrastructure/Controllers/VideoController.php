<?php

namespace App\Modules\VideoDepartment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\VideoDepartment\Application\UseCases\AddVideo\AddVideoCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\GetVideoStatistics\GetVideoStatisticsCommandInterface;
use App\Modules\VideoDepartment\Infrastructure\Requests\AddVideoRequest;
use DateTime;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    /**
     * @param AddVideoCommandInterface $addVideoCommand
     */
    public function __construct(private AddVideoCommandInterface           $addVideoCommand,
                                private GetVideoStatisticsCommandInterface $getVideoStatisticsCommand)
    {
    }

    /**
     * @param AddVideoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addVideo(AddVideoRequest $request)
    {
        try
        {

            if (isset($request->validator) && $request->validator->fails())
            {
                return response()->json($request->validator->messages(), 400);
            }

            $recordDate = DateTime::createFromFormat('Y-m-d H:i:s', $request->recordDate);

            $videoDTO = $this->addVideoCommand->execute($request->videoName, $recordDate, $request->cameramanName);

            $responseData = [
                "data" => [
                    "message" => "Video was added.",
                    "video" => [
                        'videoName' => $videoDTO->getVideoName(),
                        'recordDate' => $videoDTO->getRecordDate()->format('Y-m-d H:i:s')
                    ]
                ]
            ];

            return response()->json($responseData, 201);

        } catch (\Exception $exception)
        {
            $responseData = [
                "error" => [
                    "error" => $exception->getMessage()
                ]
            ];

            return response()->json($responseData);
        }

    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function getStatistics(Request $request)
    {
        $startRecordDate = DateTime::createFromFormat('Y-m-d H:i:s', $request->startRecordDate);
        $endRecordDate = DateTime::createFromFormat('Y-m-d H:i:s', $request->endRecordDate);

        $file = $this->getVideoStatisticsCommand->execute($startRecordDate, $endRecordDate);

        return $file;
    }

}
