<?php

namespace App\Http\Controllers\Index;

use App\DTO\PaginationDTO;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\IUserRepository;
use Illuminate\Http\Request;

class IndexAuditorController extends Controller
{
    public function __construct(
        protected IUserRepository $userRepository
    )
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pagination = new PaginationDTO($request['perPage'], $request['page'], $request->toArray());
        return $this->sendPaginatedData($this->userRepository->getAuditors($pagination->limit,$pagination->page,$pagination->filters));
    }
}
