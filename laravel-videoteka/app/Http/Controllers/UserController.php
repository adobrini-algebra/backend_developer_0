<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Rental;
use App\Models\User;
use App\Services\MembershipService;
use DateTimeImmutable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['rentals'])->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(UserRequest $request, MembershipService $membershipService)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'same:password_confirmation', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => 'required',
        ]);

        $data = array_merge($data, ['member_id' => $membershipService->generate()]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Uspješno spremljen korisnik ' . $data['first_name'] . ' ' . $data['last_name']);
    }


    public function show(User $user)
    {
        $user = User::where('id', $user->id)->with(['rentals'])->first();

        $rentals = Rental::where('user_id', $user->id)->whereNull('return_date')->with('user', 'copies.format', 'copies.movie.price', 'copies.movie.genre')->get();

        foreach ($rentals as $rental) {
            $rental->price_total = 0;
            foreach ($rental->copies as $copy) {
                $returnDate = new DateTimeImmutable($copy->pivot->return_date) ?? new DateTimeImmutable();
                $lateDays = (new DateTimeImmutable($rental->rental_date))->diff($returnDate)->format('%a');
                
                if ($lateDays <= 1) {
                    $copy->late_days = 0;
                    $copy->late_total = 0;
                    $copy->price_total = $copy->movie->price->price * $copy->format->coefficient;
                } else {
                    $copy->late_days = $lateDays - 1;
                    $copy->late_total = $copy->late_days * $copy->movie->price->late_fee * $copy->format->coefficient;
                    $copy->price_total = $copy->movie->price->price * $copy->format->coefficient + $copy->late_total;
                }
                $rental->price_total += $copy->price_total;
            } 
        }

        return view('admin.users.show', compact('user', 'rentals'));
    }


    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    { 
        $data = $request->validate([
            'member_id' => ['required', 'string', Rule::unique('users')->ignore($user)],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => ['required', 'confirmed', 'same:password_confirmation', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);  
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Uspješno izmijenjen član ' . $data['first_name'] . ' ' . $data['last_name']);
    }

 
    public function destroy(User $user)
    {
        $name = $user['first_name'] . ' ' . $user['last_name'];
        try {
            $user->delete();
        } catch (\PDOException $e) { 
            return redirect()->back()->with('danger', 'Ne možete obrisati korisnika prije nego obrišete vezane posudbe');
        }

        return redirect()->back()->with('success', 'Uspješno obrisan korisnik ' . $name);
    }
}
