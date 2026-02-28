<?php

namespace App\Http\Controllers\Admin;

use App\Concerns\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterEmployeeController extends Controller
{
    use PasswordValidationRules;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.min' => 'La contraseña debe tener entre 8 y 10 caracteres.',
            'password.max' => 'La contraseña debe tener entre 8 y 10 caracteres.',
            'password.regex' => 'La contraseña debe contener letras y números (alfanumérica).',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'operador',
            'area_designada' => null,
        ]);

        return redirect()->route('admin.register-employee')
            ->with('success', 'Empleado registrado exitosamente.');
    }

        // Listar empleados y áreas disponibles
        public function index()
        {
            $empleados = User::where('role', 'operador')->get();
            $areas = [
                'Ventanilla A',
                'Ventanilla B',
                'Ventanilla C',
                'Asesor 1',
                'Asesor 2',
                'Asesor 3',
            ];
            return view('admin.register-employee', compact('empleados', 'areas'));
        }

        // Eliminar empleado
        public function destroy($id)
        {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.register-employee')->with('success', 'Empleado eliminado.');
        }

        // Asignar área a empleado
        public function asignarArea(Request $request, $id)
        {
            $area = $request->input('area_designada');
            // Validar que el área no esté ocupada
            if (User::where('area_designada', $area)->exists()) {
                return redirect()->back()->with('error', 'El área ya está asignada a otro empleado.');
            }
            $user = User::findOrFail($id);
            $user->area_designada = $area;
            $user->save();
            return redirect()->route('admin.register-employee')->with('success', 'Área asignada correctamente.');
        }
}
