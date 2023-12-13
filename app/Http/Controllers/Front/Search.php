<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class Search extends Controller
{
    public static function index(int $id, $inputSearch)
    {
        try {
            validator(['id' => $id, 'inputSearch' => $inputSearch], [
                'inputSearch' => 'required|string|min:2',
                'id' => 'required|numeric|in:1,2,3'])->validate();
            $todo = Todo::query();
            if ($id === 1) {
                // عنوان و شرح مسئولیت
                $todo = $todo
                    ->orWhere('title', 'like', "%$inputSearch%")
                    ->orWhere('content', 'like', "%$inputSearch%");

            } elseif ($id === 2) {
                // براساس نام انجام دهنده
                $usersId = User::query()
                    ->orWhere('name', 'like', "%$inputSearch%")
                    ->orWhere('email', 'like', "%$inputSearch%")
                    ->pluck('id');

                $todo = $todo->whereIn('user_id', $usersId);
            } elseif ($id === 3) {
                // نتایج وظایف
                $todo = $todo
                    ->orWhere('result', 'like', "%$inputSearch%")
                    ->orWhere('finally_result', 'like', "%$inputSearch%");
            }
            $todo = $todo->paginate(5);
            return view('pages.search', compact('todo'));

        } catch (ValidationException $e) {
            return redirect()->back()->with('alert', 'درخواست جستوجوی ارسال شده نامعتبر است');
        }
    }
}
