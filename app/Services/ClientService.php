<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Support\Str;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllByPagination($search = [], $limit = null, $columns = ['*'])
    {
        return $this->clientRepository->scopeQuery(function ($query) use ($search) {
            return $this->getScopeQuery($query, $search);
        })->orderBy('id', 'desc')->paginate($limit, $columns);
    }

    public function getById($id)
    {
        return $this->clientRepository->find($id);
    }

    public function create($data = [])
    {
        $client = $this->clientRepository->create($data);
        $client->api_token = $this->generateToken();
        $client->save();

        return $client;
    }

    public function update($data = [], $id)
    {
        return $this->clientRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->clientRepository->delete($id);
    }

    public function generateToken()
    {
        $api_token = Str::random(80);
        $client = $this->clientRepository->findOne(['api_token' => $api_token]);

        while ($client) {
            $api_token = $this->generateToken();
        }

        return $api_token;
    }

    public function refreshToken(Client $client)
    {
        $client->api_token = $this->generateToken();
        $client->save();
    }

    protected function getScopeQuery($query, $search = [])
    {
        if (isset($search['name'])) {
            $query->where('name', 'like', '%' . $search['name'] . '%');
        }

        return $query;
    }
}
