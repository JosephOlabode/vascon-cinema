<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Repository\RepositoryInterfaces\ICinema;
use Illuminate\Http\Request;
use Validator;

class CinemaController extends Controller
{
    private $cinemaRepository;

    public function __construct(ICinema $cinemaRepository)
    {
        $this->cinemaRepository = $cinemaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $cinemas =  $this->cinemaRepository->getAllCinema();

        if(count($cinemas) > 0) {
            return response()->json([
                'title' => 'VAS Cinema',
                'message' => (count($cinemas) > 0)? 'Cinemas are available' : 'No cinema found',
                'data' => $cinemas
            ], (count($cinemas) > 0)? 200 : 404);
        }
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
            'name' => 'required',
            'location' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'Vas Cinema',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $cinema = new Cinema();
        $cinema->name = $request->input('name');
        $cinema->location = $request->input('location');

        $storedCinema =  $this->cinemaRepository->storeCinema($cinema);

        return response()->json([
            'title' => 'VAS Cinema',
            'message' => ($storedCinema != null) ? 'Cinema Saved Successfully': 'Not Saved Successfully',
            'data' => null
        ], ($storedCinema != null) ? 200 : 422);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $cinema = $this->cinemaRepository->getCinemaById($id);

        return response()->json([
            'title' => 'VAS Cinema',
            'message' => ($cinema != null)? 'Cinema found' : 'Cinema not found',
            'data' => $cinema
        ], ($cinema != null) ? 200: 404);
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
            'name' => 'required',
            'location' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'title' => 'VAS Cinema',
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $oldCinema = $this->cinemaRepository->getCinemaById($id);

        $cinema = new Cinema();
        $cinema->name = $request->input('name');
        $cinema->location = $request->input('location');

        if($oldCinema != null) {
            $updatedCinema = $this->cinemaRepository->updateCinema($oldCinema, $cinema);

            return response()->json([
                'title' => 'VAS Cinema',
                'message' => ($updatedCinema != null) ? 'Cinema updated Successfully' : 'Cinema not updated',
                'data' => $updatedCinema
            ]);
        }
        else {
            return response()->json([
                'title' => 'VAS Cinema',
                'message' => 'No Cinema Found',
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
        // getting cinema by id
        $cinema = $this->cinemaRepository->getCinemaById($id);


        if($cinema != null) {
            $deletedCinema = $this->cinemaRepository->deleteCinema($cinema);
            return response()->json([
                'title' => 'VAS Cinema',
                'message' => ($deletedCinema) ? 'Cinema Deleted Successfully': 'Unable to Delete Cinema',
                'data' => $deletedCinema
            ], $deletedCinema ? 200 : 422);
        }
        else {
            return response()->json([
                'title' => 'VAS Cinema',
                'message' => 'No cinema found',
                'data' => null
            ], 404);
        }
    }
}
