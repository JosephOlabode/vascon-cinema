<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Repository\RepositoryInterfaces\IShowtime;
use Illuminate\Http\Request;
use Validator;

class ShowTimeController extends Controller
{

    private $showTimeRepository = null;

    public function __construct(IShowtime $showTimeRepository)
    {
        $this->$showTimeRepository = $showTimeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
       $showTimes  = $this->showTimeRepository->getAllShowTime();

       return response()->json([
           'title' => 'VAS Show Time',
           'message' => (count($showTimes) > 0) ? 'Show times are available': 'No Show time found',
           'data' => $showTimes
       ], (count($showTimes) > 0) ? 200: 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $showTime = new Showtime();
        $showTime->date = $request->input('date');
        $showTime->start_time = $request->input('startTime');
        $showTime->end_time = $request->input('endTime');

        $savedShowTime = $this->showTimeRepository->storeShowTime($showTime);

        return response()->json([
            'title' => 'Vas Show Time',
            'message' => ($savedShowTime != null)?  'Show Time Saved Successfully': 'Show Time not saved',
            'data' => []
        ], ($savedShowTime != null) ? 200 : 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $showTime = $this->showTimeRepository->getShowTimeById($id);

        return response()->json([
            'title' => 'VAS Show Time',
            'message' => ($showTime != null) ? 'Show Time Available' : 'No Show Time Found',
            'data' => $showTime
        ], ($showTime != null) ? 200: 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Show Time',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $oldShowTime = $this->showTimeRepository->getShowTimeById($id);

        $showTime = new Showtime();
        $showTime->date = $request->input('date');
        $showTime->start_time = $request->input('startTime');
        $showTime->end_time = $request->input('endTime');

        if($oldShowTime != null) {

            $updatedShowTime = $this->showTimeRepository->updateShowTime($oldShowTime, $showTime);
            return response()->json([
                'title' => 'VAS Show Time',
                'message' => ($updatedShowTime != null) ? 'Show Time updated Successfully' : 'Show time not updated',
                'data' => null
            ], ($updatedShowTime != null) ? 200 : 422);
        }
        else {
            return response()->json([
                'title' => 'VAS Show Time',
                'message' => 'No show time Found',
                'data' => null
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // getting show time by id
        $showTime = $this->showTimeRepository->getShowTimeById($id);


        if($showTime != null) {
            $deletedShowTime = $this->showTimeRepository->deleteShowTime($showTime);
            return response()->json([
                'title' => 'VAS Show Time',
                'message' => ($deletedShowTime) ? 'Show Time Deleted Successfully': 'Unable to Delete Show time',
                'data' => $deletedShowTime
            ], $deletedShowTime ? 200 : 422);
        }
        else {
            return response()->json([
                'title' => 'VAS Show Time',
                'message' => 'No show time found',
                'data' => null
            ], 404);
        }
    }
}
