<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class DatasetController extends Controller
{
    public function showDataset()
    {
        $showDataset = Dataset::paginate(50);
        $showDataset->onEachSide(1);
        return view('table', ['showDataset' => $showDataset]);
    }
}
