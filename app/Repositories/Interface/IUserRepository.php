<?php
namespace App\Repositories\Interface;

use App\DTO\AuditorDTO;
use App\DTO\UpdateAuditorDTO;
use App\DTO\UserDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function getUserByCpf(string $cpf);
    public function getUserByEmail(string $email);
    public function updateUser(UserDTO $user);
    public function getUser(string|int $id);
    public function getUserWithOrganization($id);
    public function getUserAccessLevelByCpf($cpf): null|int;
    public function updateOrCreateAuditor(AuditorDTO $data);
    public function updateAuditorById(UpdateAuditorDTO $data, $id);
    public function updateAuditorPassword($id, string $password);
    public function deleteUser($id);
    public function getAuditors(int $limit, int $page, array $filters): LengthAwarePaginator;
}
