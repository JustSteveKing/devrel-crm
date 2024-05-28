<?php

declare(strict_types=1);

namespace App\Http\Controllers\Contacts;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Domains\Network\Services\ContactService;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class IndexController
{
    public function __construct(
        private AuthManager $auth,
        private ContactService $service,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $contacts = $this->service->query(
            builder: Contact::query()->where(
                column: 'user_id',
                operator: '=',
                value: $this->auth->id(),
            ),
        )->all();

        return new JsonResponse(
            data: ContactResource::collection(
                resource: $contacts,
            ),
        );
    }
}
