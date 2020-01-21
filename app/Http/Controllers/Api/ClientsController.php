<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ClientsController extends Controller
{

    /**
     * Display a listing of the assets.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $clients = client::paginate(25);

        $data = $clients->transform(function ($client) {
            return $this->transform($client);
        });

        return $this->successResponse(
            'Clients were successfully retrieved.',
            $data,
            [
                'links' => [
                    'first' => $clients->url(1),
                    'last' => $clients->url($clients->lastPage()),
                    'prev' => $clients->previousPageUrl(),
                    'next' => $clients->nextPageUrl(),
                ],
                'meta' =>
                [
                    'current_page' => $clients->currentPage(),
                    'from' => $clients->firstItem(),
                    'last_page' => $clients->lastPage(),
                    'path' => $clients->resolveCurrentPath(),
                    'per_page' => $clients->perPage(),
                    'to' => $clients->lastItem(),
                    'total' => $clients->total(),
                ],
            ]
        );
    }

    /**
     * Store a new client in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->getValidator($request);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->all());
            }

            $data = $this->getData($request);
            
            $client = client::create($data);

            return $this->successResponse(
			    'Client was successfully added.',
			    $this->transform($client)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Display the specified client.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = client::findOrFail($id);

        return $this->successResponse(
		    'Client was successfully retrieved.',
		    $this->transform($client)
		);
    }

    /**
     * Update the specified client in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
            $validator = $this->getValidator($request);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->all());
            }

            $data = $this->getData($request);
            
            $client = client::findOrFail($id);
            $client->update($data);

            return $this->successResponse(
			    'Client was successfully updated.',
			    $this->transform($client)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Remove the specified client from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $client = client::findOrFail($id);
            $client->delete();

            return $this->successResponse(
			    'Client was successfully deleted.',
			    $this->transform($client)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }
    
    /**
     * Gets a new validator instance with the defined rules.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Validator
     */
    protected function getValidator(Request $request)
    {
        $rules = [
            'name' => 'string|min:1|max:255|nullable',
            'prenom' => 'string|min:1|nullable',
            'tel' => 'string|min:1|nullable',
            'addresse' => 'string|min:1|nullable', 
        ];

        return Validator::make($request->all(), $rules);
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'name' => 'string|min:1|max:255|nullable',
            'prenom' => 'string|min:1|nullable',
            'tel' => 'string|min:1|nullable',
            'addresse' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

    /**
     * Transform the giving client to public friendly array
     *
     * @param App\Models\client $client
     *
     * @return array
     */
    protected function transform(client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'prenom' => $client->prenom,
            'tel' => $client->tel,
            'addresse' => $client->addresse,
        ];
    }


}
