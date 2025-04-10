<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function getForms()
    {
        return Form::all();
    }

    public function getForm($id)
    {
        return Form::find($id);
    }

    public function createForm(Request $request)
    {
        $formulario = new Form();
        $formulario->nombre = $request->nombre;
        $formulario->campos = $request->campos;  // Los campos se envían como un array
        $formulario->save();

        return response()->json($formulario, 201);
    }

    public function updateForm(Request $request, $id)
    {
        $formulario = Form::find($id);
        $formulario->nombre = $request->nombre;
        $formulario->campos = $request->campos;
        $formulario->save();

        return response()->json($formulario);
    }


    public function eliminarFormulario($id)
{
    $formulario = Form::find($id);

    if (!$formulario) {
        return response()->json(['mensaje' => 'Formulario no encontrado'], 404);
    }

    $formulario->delete();

    return response()->json(['mensaje' => 'Formulario eliminado correctamente'], 200);
}

}
