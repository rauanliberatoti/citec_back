<?php

namespace App\Http\Controllers\Update;

use App\DTO\UpdateAuditorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAuditorRequest;
use App\Services\Update\UpdateAuditorService;
use Illuminate\Http\Request;

class UpdateAuditorController extends Controller
{
    public function __construct(
        protected UpdateAuditorService $updateAuditorService
    ) {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateAuditorRequest $request, $id)
    {
        $request = $request->validated();
        $data = new UpdateAuditorDTO($id,...$request);
        return $this->send($this->updateAuditorService->handle($data));
    }
}
