<?php

namespace App\Http\Controllers\Welcome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
 * @OA\Get(
 * path="/api/welcome",
 * summary="Display Welcome Message",
 * description="Display Welcome Message",
 * operationId="WelcomeMessage",
 * tags={"Welcome"},
 * @OA\Response(
 *    response=200,
 *     description="Welcome Message Fetched"
 * )
 *)
 */
    public function index(Request $request)
    {
        return response()->json(["message"=>"Welcome to WeForYouth"],200);
    }
}
