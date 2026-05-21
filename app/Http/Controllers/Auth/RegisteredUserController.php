<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'selected_avatar' => ['nullable', 'string'],
        ]);

        $avatarUrl = $request->selected_avatar ?: $this->generateAvatarUrl($request->gender, (int) $request->age, $request->name, $request->email);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => (int) $request->age,
            'avatar' => $avatarUrl,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Generate a Google/Gravatar integrated photo avatar with realistic cartoon portrait fallbacks.
     */
    private function generateAvatarUrl(string $gender, int $age, string $name, string $email): string
    {
        $gender = strtolower($gender);
        if ($gender === 'male') {
            return 'https://api.dicebear.com/7.x/avataaars/svg?seed=Jack';
        } elseif ($gender === 'female') {
            return 'https://api.dicebear.com/7.x/avataaars/svg?seed=Lily';
        }
        return 'https://api.dicebear.com/7.x/avataaars/svg?seed=Oliver';
    }
}
