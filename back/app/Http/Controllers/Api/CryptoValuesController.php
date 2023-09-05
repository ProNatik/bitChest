<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Crypto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CryptoValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cryptos = Crypto::with('cryptoValues')
                            ->where(function (Builder $query) {
                                return $query->orderBy('date', 'desc');
                            })
                            ->get();

        return response()->json($cryptos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {


        try {
            $cryptos = DB::select('SELECT c.id, c.name, cv.value, cv.date FROM crypto_values AS cv
                                JOIN cryptos AS c ON c.id = cv.crypto_id
                                WHERE cv.crypto_id = ? order by cv.date', [$id]);

            return response()->json($cryptos);

        } catch (\Exception $exception) {
            return $exception;
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crypto $crypto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crypto $crypto)
    {
        //
    }
}
