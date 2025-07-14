<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function user_registered(Request $request)
    {
        $user = User::where('documento', $request->documento)->first();

        if ($user) {
            return response()->json(['registered' => true, 'user_id' => $user->id, 'nombre' => $user->nombre]);
        } else {
            return response()->json(['registered' => false]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:11|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'documento' => 'required|string|max:20|unique:users'
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'documento' => $request->documento,
        ]);

        return response()->json(['message' => 'Usuario registrado exitosamente', 'user_id' => $user->id, 'nombre' => $user->nombre], 201);
    }

    public function factura_register(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'num_factura' => 'required|string|max:255|unique:facturas',
            'foto_factura' => 'required|string',
        ]);

        $factura = Factura::create([
            'id_user' => $request->id_user,
            'num_factura' => $request->num_factura,
            'foto_factura' => $request->foto_factura,
        ]);

        return response()->json(['message' => 'Factura registrada exitosamente', 'factura_id' => $factura->id], 201);
    }

    // VALIDATIONS
    public function telValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telefono' => 'required|numeric|digits:10|unique:users'
        ], [
            'telefono.required' => 'Opps! el campo teléfono es obligatorio. Por favor, verifica el número e intenta nuevamente.',
            'telefono.numeric' => 'Opps! el campo teléfono debe contener solo números. Por favor, verifica el número e intenta nuevamente.',
            'telefono.digits' => 'Opps! el campo teléfono debe tener 10 dígitos. Por favor, verifica el número e intenta nuevamente.',
            'telefono.unique' => 'Opps! este teléfono ya está registrado en nuestro sistema. Por favor, verifica el número e intenta nuevamente.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'first_error' => $validator->errors()->first()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Teléfono válido'
        ], 200);
    }

    public function docValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'documento' => 'required|numeric|max_digits:10|unique:users'
        ], [
            'documento.required' => 'Opps! el campo documento es obligatorio. Por favor, verifica el número e intenta nuevamente.',
            'documento.numeric' => 'Opps! el campo documento solo debe contener números. Por favor, verifica el número e intenta nuevamente.',
            'documento.max_digits' => 'Opps! el campo documento no puede tener más de 10 caracteres. Por favor, verifica el número e intenta nuevamente.',
            'documento.unique' => 'Opps! este documento ya está registrado en nuestro sistema. Por favor, verifica el número e intenta nuevamente.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'first_error' => $validator->errors()->first()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'documento válido'
        ], 200);
    }

    public function emailValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users'
        ], [
            'email.required' => 'Opps! el campo correo es obligatorio. Por favor, verifica el correo e intenta nuevamente.',
            'email.email' => 'Opps! el campo correo debe ser una dirección de correo electrónico válida. Por favor, verifica el correo e intenta nuevamente.',
            'email.max' => 'Opps! el campo correo no puede tener más de 255 caracteres. Por favor, verifica el correo e intenta nuevamente.',
            'email.unique' => 'Opps! este correo ya está registrado en nuestro sistema. Por favor, verifica el correo e intenta nuevamente.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'first_error' => $validator->errors()->first()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Email válido'
        ], 200);
    }
}
