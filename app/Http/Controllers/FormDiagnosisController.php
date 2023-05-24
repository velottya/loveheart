<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\FormDiagnosis;
use App\Models\ResultLatest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FormDiagnosisController extends Controller
{
    public function history()
    {
        $FormDiagnosis = FormDiagnosis::where('id', Auth::user()->id)->get();
        return view('home.history', ['FormDiagnosis' => $FormDiagnosis]);
    }
    public function result()
    {
        $ResultLatest = ResultLatest::where('id', Auth::user()->id)->latest('id')->first();
        return view('home.result', compact('ResultLatest'));
    }
    public function create()
    {
        return view('home.form');
    }
    public function store(Request $request)
    {
        $validatedata = $request->validate(
            [
                'name' => 'required|min:3|max:100',
                'age' => 'required|numeric|min:10|max:100',
                'sex' => 'required|in:M,F',
                'RBP' => 'required|numeric|min:10|max:1000',
                'MHR' => 'required|numeric|min:10|max:220',
                'CL' => 'required|numeric|min:10|max:1000',
                'date' => 'required'
            ]
        );

        $user_id = Auth::user()->id;
        $name = $request->input('name');
        $age = $request->input('age');
        $sex = $request->input('sex');
        $RBP = $request->input('RBP');
        $MHR = $request->input('MHR');
        $CL = $request->input('CL');
        $date = $request->input('date');

        $fixMHR = $MHR - $age;

        // Menghitung Nilai Probabilitas Prior
        $total1 = Dataset::where('result', 1)->get();
        $total0 = Dataset::where('result', 0)->get();

        // Menghitung Peluang Dari Inputan User
        if ($sex == 'M') {
            if ($age <= 45) {
                if ($RBP == 120) {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                } else {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                }
            } else {
                if ($RBP == 120) {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 45)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                } else {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '>', 45)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                }
            }
        } else {
            if ($age <= 55) {
                if ($RBP == 120) {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                } else {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'M')->where('age', '<=', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                }
            } else {
                if ($RBP == 120) {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '<=', 55)->where('RBP', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                } else {
                    if ($MHR <= $fixMHR) {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '<=', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    } else {
                        if ($CL <= 200) {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '<=', 200)->count() / Dataset::count();
                        } else {
                            // Peluang Result 1
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count() / count($total1);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 1)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 1)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 1)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 1)->count();
                            $p_ya = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Result 0
                            $p_1 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count() / count($total0);
                            $p_2 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('result', 0)->count();
                            $p_3 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('result', 0)->count();
                            $p_4 = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->where('result', 0)->count() / Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('result', 0)->count();
                            $p_tidak = $p_1 * $p_2 * $p_3 * $p_4;
                            // Peluang Kondisi Tanpa Memperhatikan Result
                            $p_kond = Dataset::where('sex', 'F')->where('age', '>', 55)->where('RBP', '!=', 120)->where('MHR', '>', $fixMHR)->where('CL', '>', 200)->count() / Dataset::count();
                        }
                    }
                }
            }
        }
        $bayes = ($p_ya * $p_kond) / (($p_ya * $p_kond) + ($p_tidak * $p_kond));
        $bayes <= 0.5 ? $result = 0 : $result = 1;
        $percent = $bayes * 100;
        FormDiagnosis::create([
            'user_id' => $user_id,
            'name' => $name,
            'age' => $age,
            'sex' => $sex,
            'RBP' => $RBP,
            'MHR' => $MHR,
            'CL' => $CL,
            'date' => $date,
            'result' => $result,
            'percent' => $percent
        ]);
        return redirect()->route('result');
    }
    public function destroy(Request $requst, $id)
    {
        $destroy = ResultLatest::findOrFail($id);
        $destroy->delete();

        return redirect()->route('history');
    }
}
