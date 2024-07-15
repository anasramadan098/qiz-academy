<?php
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (Auth::check()) {
            $user = Auth::user();
            $user->role = 'normal';
            $user->save();

            $end_date = Carbon::parse($user->role_start_date)->addYear();
            $now = now();

            if ($end_date < $now) {
                $user->role = 'normal';
                $user->save();
            }
        }
    }
}