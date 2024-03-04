<?php

namespace App\Modules\VideoDepartment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\VideoDepartment\Application\UseCases\AddVideo\AddVideoCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\GetVideo\GetVideoCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\GetVideoStatistics\GetVideoStatisticsCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\SaveVideoFromFile\SaveVideoFromFileCommandInterface;
use App\Modules\VideoDepartment\Infrastructure\Requests\AddVideoRequest;
use App\Modules\VideoDepartment\Infrastructure\Requests\GetVideoRequest;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class VideoController extends Controller
{

    /**
     * @param AddVideoCommandInterface $addVideoCommand
     * @param GetVideoStatisticsCommandInterface $getVideoStatisticsCommand
     * @param SaveVideoFromFileCommandInterface $saveVideoFromFileCommand
     * @param GetVideoCommandInterface $getVideoCommand
     */
    public function __construct(private AddVideoCommandInterface           $addVideoCommand,
                                private GetVideoStatisticsCommandInterface $getVideoStatisticsCommand,
                                private SaveVideoFromFileCommandInterface  $saveVideoFromFileCommand,
                                private GetVideoCommandInterface           $getVideoCommand)
    {
    }

    /**
     * @param AddVideoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function addVideo(AddVideoRequest $request)
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
     * @param GetVideoRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getVideoByChunks(GetVideoRequest $request)
    {

        if (isset($request->validator) && $request->validator->fails())
        {
            return response()->json($request->validator->messages(), 400);
        }

        $startRecordDate = DateTime::createFromFormat('Y-m-d H:i:s', $request->startRecordDate);

        $video = $this->getVideoCommand->execute($request->guid, $startRecordDate, $request->chunkLength);

        return response()->json($video, 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getStatistics(Request $request)
    {
        try
        {
            $startRecordDate = DateTime::createFromFormat('Y-m-d H:i:s', $request->startRecordDate);
            $endRecordDate = DateTime::createFromFormat('Y-m-d H:i:s', $request->endRecordDate);

            $fileAssetPath = $this->getVideoStatisticsCommand->execute($startRecordDate, $endRecordDate);

            return asset($fileAssetPath);
        } catch (\Exception $exception)
        {
            return response()->json(['status' => 'error',
                'message' => $exception->getMessage()]);
        }

    }

    /**
     * @param Request $request
     * @return void
     */
    public function saveVideoFromFile(Request $request)
    {

        $file = $request->file;

        $fileName = time() . $file->getClientOriginalName();
        $filePath = Storage::putFileAs(
            "statistics", $file, $fileName
        );

        $result = $this->saveVideoFromFileCommand->execute($fileName);

    }

}
