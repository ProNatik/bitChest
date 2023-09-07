<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CryptoWallet;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CryptoWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cryptos = DB::select('SELECT cw.*, c.name FROM crypto_wallets AS cw
                                JOIN cryptos c ON c.id = cw.crypto_id
                                WHERE cw.user_id = ? order by cw.id desc', [Auth::user()->id]);

            return response()->json($cryptos);

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prix = $request->quantity * $request->price;

        if ($prix > $request->solde) {
            return Response::json(
                [
                    "message" => "You don't have the money",
                    "status" => \Illuminate\Http\Response::HTTP_OK,
                ],
                \Illuminate\Http\Response::HTTP_OK,
            );
        } else {
            $newSolde = $request->solde - $prix;
            try {

                $insertCryptoWallet = DB::insert('INSERT INTO crypto_wallets (purchase_at, quantity, user_id, crypto_id) VALUES (now(), ?, ?, ?)',
                    [
                        $request->quantity,
                        Auth::user()->id,
                        $request->id
                    ]
                );
                $updateSolde = DB::update('UPDATE wallets SET solde = ? WHERE user_id = ?',
                    [
                        $newSolde,
                        Auth::user()->id
                    ]
                );
                //réduire son solde

                return Response::json(
                    [
                        "message" => "L'opération s'est déroulée avec succès",
                        "status" => \Illuminate\Http\Response::HTTP_OK,
                        "newSolde" => $newSolde
                    ],
                    \Illuminate\Http\Response::HTTP_OK,
                );
            } catch (ValidationException $exception) {
                return Response::json([
                    "message" => $exception,
                    "status" => \Illuminate\Http\Response::HTTP_OK,
                ]);
            }
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(CryptoWallet $cryptoWallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CryptoWallet $cryptoWallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CryptoWallet $cryptoWallet)
    {
        try {
            // $cryptos = DB::select('SELECT c.id, c.name, cv.value, cv.date FROM crypto_values AS cv
            //                     JOIN cryptos AS c ON c.id = cv.crypto_id
            //                     WHERE cv.crypto_id = ? order by cv.date', [$id]);

            $cryptoWallet->delete();

            return response()->json(null, 201);

        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
