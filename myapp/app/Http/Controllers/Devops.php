<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class Devops extends Controller {
    public function __invoke()
    {
        $data = DB::table('welcome')->get();
        return view('welcome', ['data' => $data]);
    }
}
