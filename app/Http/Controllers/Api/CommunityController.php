<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Community;

class CommunityController extends Controller
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

        return response()->json([
            'success' => true,
            'message' => 'Community registered succesfully',
            'community' => $community->refresh(),
        ], 200);
    }
}