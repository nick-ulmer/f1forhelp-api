<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ContactController extends Controller
{
    #[OA\Post(
        path: '/api/contact',
        summary: 'Submit a contact message',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'email', 'message'],
                properties: [
                    new OA\Property(property: 'name',    type: 'string', maxLength: 100,  example: 'Jane Doe'),
                    new OA\Property(property: 'email',   type: 'string', maxLength: 150,  example: 'jane@example.com'),
                    new OA\Property(property: 'message', type: 'string', maxLength: 2000, example: 'Hey, loved your portfolio!'),
                    new OA\Property(property: 'website', type: 'string', description: 'Honeypot - leave empty', example: ''),
                ]
            )
        ),
        tags: ['Contact'],
        responses: [
            new OA\Response(response: 201, description: 'Message received'),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 429, description: 'Too many requests'),
        ]
    )]
    public function store(StoreContactRequest $request): JsonResponse
    {
        // Hash the IP
        $ipHash = hash('sha256', $request->ip() . env('IP_SALT', 'fallback_salt'));

        ContactMessage::create([
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'message' => $request->input('message'),
            'ip_hash' => $ipHash,
        ]);

        return response()->json([
            'message' => 'Thanks for reaching out! I\'ll reply to your message soon.',
        ], 201);
    }
}
