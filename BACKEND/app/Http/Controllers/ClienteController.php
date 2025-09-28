<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::query()->latest()->paginate(10);
        return ClienteResource::collection($clientes);
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->validated());
        return (new ClienteResource($cliente))->response()->setStatusCode(201);
    }

    public function show(Cliente $cliente)
    {
        return new ClienteResource($cliente);
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());
        return new ClienteResource($cliente);
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->noContent();
    }
}
