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
                                WHERE cw.user_id = ? AND cw.sell_at is NULL order by cw.id desc', [Auth::user()->id]);

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
            $crypto_values = DB::select('SELECT * FROM `crypto_values`
                                    WHERE `crypto_id` = ? order by date desc;', [$cryptoWallet->crypto_id]);
            $cryptoValueToday = $crypto_values[0]->value;

            $addToSolde = $cryptoWallet->quantity * $cryptoValueToday;

            $selectSolde = DB::select('SELECT solde FROM wallets WHERE user_id = ?', [Auth::user()->id]);

            $updateSolde = DB::update('UPDATE wallets SET solde = ? WHERE user_id = ?',
                [
                    $selectSolde[0]->solde + $addToSolde,
                    Auth::user()->id
                ]
            );

            $newSolde = DB::select('SELECT solde FROM wallets WHERE user_id = ?', [Auth::user()->id]);


            $cryptoWallet->delete();


            return Response::json(
                [
                    "addToSolde" => $addToSolde,
                    "status" => \Illuminate\Http\Response::HTTP_OK,
                    "newSolde" => $newSolde
                ],
                \Illuminate\Http\Response::HTTP_OK,
            );
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
