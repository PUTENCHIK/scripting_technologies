<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClaimController extends Controller {
    public function __construct() {
        $_POST = [];
    }

    public function claim() {
        return view('claim');
    }

    public function process_claim(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'trend' => 'required',
            'agree' => 'required'
        ]);
        
        $data = $request->except('_token');
        Storage::disk('local')->put(Str::ulid().'.json', json_encode($data, 448));
        
        return redirect()->to('/success')->send();
    }

    public function success() {
        return view('success');
    }

    public function all_claims() {
        $files = Storage::disk('local')->files();
        $claims = [];
        foreach($files as $file) {
            if (str_contains($file, '.json')) {
                $claims[] = json_decode(Storage::disk('local')->get($file));
            }
        }

        return view('all_claims', ['claims' => $claims]);
    }
}
