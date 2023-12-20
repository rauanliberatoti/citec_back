<?php

namespace App\Http\Controllers\Create;

use App\DTO\AuditorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAuditorRequest;
use App\Services\Create\CreateAuditorService;

class CreateAuditorController extends Controller
{
    public function __construct(
        protected CreateAuditorService $createAuditorService
    ){}
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateAuditorRequest $request)
    {
        $request = $request->validated();
        $data = new AuditorDTO(...$request);
        return $this->send($this->createAuditorService->handle($data));
    }
}
