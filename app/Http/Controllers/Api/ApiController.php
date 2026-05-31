<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function sync(Request $request)
    {
        try {
        $apiKey = $request->header('X-API-KEY');

        $validator = Validator::make($request->all(), [
            'current_version' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Bad Request: ' . $validator->errors()->first()
            ], 422);
        }

        if (!$request->has('current_version')) {
            return response()->json([
                'message' => 'Bad Request: current_version query parameter is required.'
            ], 400);
        }
        
        if ($apiKey !== env('API_KEY')) {
            return response()->json([
                'message' => 'Unauthorized: Invalid API key.'
            ], 401);
        }

        $currentVersion = $request->query('current_version');
        $serverVersion = \App\Models\KnowledgeBaseVersion::latestVersion();

        // Jika belum ada versi yg dirilis
        if (!$serverVersion) {
            return response()->json([
                'message' => 'unreleased',
                'version' => 0
            ], 404);
        }

        // Jika client mengirim versi, dan versinya sama dengan server
        if ($currentVersion !== null && (int)$currentVersion == $serverVersion->version) {
            return response()->json([
                'message' => 'uptodate',
                'version' => $serverVersion->version
            ], 200);
        }

        // Jika versi berbeda (butuh update)
        $records = \App\Models\KnowledgeVersionRecord::where('version', $serverVersion->version)->get();

        $diseases = $records->unique('disease_code')->map(function ($item) {
            return [
                'disease_code'  => $item->disease_code,
                'name'          => $item->disease_name,
                'description'   => $item->disease_description,
                'treatment'     => $item->disease_treatment,
            ];
        })->values();
        
        $symptoms = $records->unique('symptom_code')->map(function ($item) {
            return [
                'symptom_code'  => $item->symptom_code,
                'name'          => $item->symptom_name,
            ];
        })->values();

        $rules = $records->map(function ($item) {
            return [
                'disease_code'  => $item->disease_code,
                'symptom_code'  => $item->symptom_code,
                'mb'            => $item->mb,
                'md'            => $item->md,
            ];
        })->values();

        return response()->json([
            'message' => 'updaterequired',
            'version' => $serverVersion->version,
            'data' => [
                'diseases' => $diseases,
                'symptoms' => $symptoms,
                'rules'    => $rules,
            ]
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Internal Server Error: ' . $e->getMessage()
        ], 500);
    }
    }
}