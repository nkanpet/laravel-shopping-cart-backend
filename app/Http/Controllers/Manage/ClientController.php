<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = $this->clientService->getAllByPagination($request->all());

        return view('manage.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->clientService->create($request->all());

        return redirect()->route('manage.clients.index')->with('flash_message', 'Create client success.')->with('alert-class', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->clientService->getById($id);

        return view('manage.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->clientService->getById($id);

        return view('manage.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->clientService->update($request->all(), $id);

        return redirect()->route('manage.clients.index')->with('flash_message', 'Update client success.')->with('alert-class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->clientService->delete($id);

        return redirect()->route('manage.clients.index')->with('flash_message', 'Delete client success.')->with('alert-class', 'alert-success');
    }

    public function refreshToken($id)
    {
        $client = $this->clientService->getById($id);
        $this->clientService->refreshToken($client);

        return redirect()->route('manage.clients.show', ['client' => $client])->with('flash_message', 'Client refresh token success.')->with('alert-class', 'alert-success');
    }
}
