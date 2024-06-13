<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    //
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->name = $request->name;
        $cliente->last_name = $request->last_name;
        $cliente->phone_number = $request->phone_number;
        $cliente->identification_type = $request->identification_type;
        $cliente->identification_number = $request->identification_number;
        $cliente->email = $request->email;
        $cliente->password = Hash::make($request->password);
        $cliente->save();

        return redirect()->route('users.index')->with('success', 'Cliente actualizado exitosamente');
    }

}

?>
