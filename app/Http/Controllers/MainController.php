<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Factura;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|numeric|digits:10|unique:users',
            'ciudad' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'documento' => 'required|numeric|max_digits:10|unique:users'
        ], [
            'nombre.required' => 'Opps! el campo nombre es obligatorio. Por favor, verifica el nombre e intenta nuevamente.',
            'nombre.string' => 'Opps! el campo nombre debe ser una cadena de texto. Por favor, verifica el nombre e intenta nuevamente.',
            'nombre.max' => 'Opps! el campo nombre no puede tener más de 255 caracteres. Por favor, verifica el nombre e intenta nuevamente.',
            
            'apellido.required' => 'Opps! el campo apellido es obligatorio. Por favor, verifica el apellido e intenta nuevamente.',
            'apellido.string' => 'Opps! el campo apellido debe ser una cadena de texto. Por favor, verifica el apellido e intenta nuevamente.',
            'apellido.max' => 'Opps! el campo apellido no puede tener más de 255 caracteres. Por favor, verifica el apellido e intenta nuevamente.',

            'ciudad.required' => 'Opps! el campo ciudad es obligatorio. Por favor, verifica la ciudad e intenta nuevamente.',
            'ciudad.string' => 'Opps! el campo ciudad debe ser una cadena de texto. Por favor, verifica la ciudad e intenta nuevamente.',
            'ciudad.max' => 'Opps! el campo ciudad no puede tener más de 255 caracteres. Por favor, verifica la ciudad e intenta nuevamente.',

            'telefono.required' => 'Opps! el campo teléfono es obligatorio. Por favor, verifica el número e intenta nuevamente.',
            'telefono.numeric' => 'Opps! el campo teléfono debe contener solo números. Por favor, verifica el número e intenta nuevamente.',
            'telefono.digits' => 'Opps! el campo teléfono debe tener 10 dígitos. Por favor, verifica el número e intenta nuevamente.',
            'telefono.unique' => 'Opps! este teléfono ya está registrado en nuestro sistema. Por favor, verifica el número e intenta nuevamente.',

            'documento.required' => 'Opps! el campo documento es obligatorio. Por favor, verifica el número e intenta nuevamente.',
            'documento.numeric' => 'Opps! el campo documento solo debe contener números. Por favor, verifica el número e intenta nuevamente.',
            'documento.max_digits' => 'Opps! el campo documento no puede tener más de 10 caracteres. Por favor, verifica el número e intenta nuevamente.',
            'documento.unique' => 'Opps! este documento ya está registrado en nuestro sistema. Por favor, verifica el número e intenta nuevamente.',

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

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'ciudad' => $request->ciudad,
            'email' => $request->email,
            'documento' => $request->documento,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'usuario registrado exitosamente',
            'user_id' => $user->id,
            'nombre' => $user->nombre
        ], 200);
    }

    public function register_factura(Request $request){
        $validator = Validator::make($request->all(), [
            'foto_factura' => 'required|string',
            'foto_producto' => 'required|string'
        ], [
            'foto_factura.required' => 'Opps! el campo foto_factura es obligatorio. Por favor, verifica la foto e intenta nuevamente.',
            'foto_producto.required' => 'Opps! el campo foto_producto es obligatorio. Por favor, verifica la foto e intenta nuevamente.'
        ]);

        $factura = Factura::create([
            'id_user' => $request->id_user,
            'foto_factura' => $this->uploadFile($request->foto_factura),
            'foto_producto' => $this->uploadFile($request->foto_producto)
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
            'message' => 'factura registrada exitosamente',
        ], 200);
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

    public function uploadFile($url)
    {
        $imageContent = file_get_contents($url);

        // Crea un nombre único para la imagen
        $path = "public/photos/" . Str::uuid() . ".jpg";
        Storage::disk('local')->put($path, $imageContent);

        return $path;
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
