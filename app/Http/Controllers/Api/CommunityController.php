<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends ApiController
{
    /**
     * Register user.
     *
     * @return json
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'description' => 'nullable',
        ]);

        $community = Community::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $data=array('success' => true,'message' => 'Community registered succesfully','community' => $community->refresh());
        return $this->successResponse($data,200);
    }
}