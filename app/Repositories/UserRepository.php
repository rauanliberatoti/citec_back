<?php
namespace App\Repositories;

use App\Constants\UserConstant;
use App\DTO\AuditorDTO;
use App\DTO\UpdateAuditorDTO;
use App\DTO\UserDTO;
use App\Models\User;
use App\Repositories\Interface\IUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function getUserByCpf(string $cpf)
    {
        return User::where('cpf', $cpf)->first();
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function updateUser(UserDTO $data)
    {
        return User::where('id', $data->id)->update([
            'name' => $data->name,
            'email' => $data->email,
            'cpf' => $data->cpf,
            'address' => $data->address,
            'cellphone' => $data->cellphone,
            'complement' => $data->complement,
            'number' => $data->number,
            'neighborhood' => $data->neighborhood,
            'zipCode' => $data->zipCode,
            'city' => $data->city,
            'state' => $data->state,
            'telephone' => $data->telephone
        ]);
    }

    public function getUser($id)
    {
        return User::where('id', $id)->first();
    }

    public function getUserWithOrganization($id)
    {
        return User::where('id', $id)->with('organization')->first();
    }

    public function getUserAccessLevelByCpf($cpf): null|int
    {
        $user = User::where('cpf', $cpf)->first();
        if (!$user)
            return null;
        if ($user->access_level == UserConstant::CITIZEN) {
            return UserConstant::CITIZEN;
        }
        if ($user->access_level == UserConstant::AUDITOR) {
            return UserConstant::AUDITOR;
        }
        return UserConstant::GENERAL_AUDITOR;
    }

    public function updateOrCreateAuditor(AuditorDTO $data)
    {
        $user = User::updateOrCreate(['cpf' => $data->cpf], [
            'name' => $data->name,
            'email' => $data->email,
            'cpf' => $data->cpf,
            'password' => Hash::make($data->password),
            'access_level' => UserConstant::AUDITOR,
            'cellphone' => $data->cellphone,
            'telephone' => $data->telephone,
            'register_number' => $data->register_number,
            'organization_id' => $data->organization,
        ]);
        return $user;
    }

    public function updateAuditorById(UpdateAuditorDTO $data, $id)
    {
        $user = User::where('id', $id)->update([
            'name' => $data->name,
            'email' => $data->email,
            'cpf' => $data->cpf,
            'access_level' => UserConstant::AUDITOR,
            'cellphone' => $data->cellphone,
            'telephone' => $data->telephone,
            'register_number' => $data->register_number,
            'organization_id' => $data->organization,
        ]);
        return $user;
    }

    public function updateAuditorPassword($id, ?string $password)
    {
        if (!$password)
            return null;
        $user = User::where('id', $id)->update([
            'password' => Hash::make($password),
        ]);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id)->delete();
        return $user;
    }

    public function getAuditors(int $limit, int $page, array $filters): LengthAwarePaginator
    {
        return User::queryFilter($filters)
            ->select('users.id', 'users.name', 'register_number', 'cpf', 'organization_id','organizations.name as organization_name')
            ->join('organizations', 'users.organization_id', '=', 'organizations.id')
            ->where('access_level', UserConstant::AUDITOR)
            ->orderBy('name', 'asc')
            ->paginate($limit, ['*'], 'page', $page);
        ;
    }
}
