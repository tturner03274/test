<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleAPIController extends Controller
{

    public function __invoke(Request $request)
    {

        // Strip all whitespace from string and trim and overwrite ( merge ) request param
        $request->merge([
            'registration' => preg_replace('/\s+/', '', $request->registration)
        ]);

        // validate registration
        $validatedData = $request->validate([
            'registration' => ['required', 'string', 'min:2', 'regex:/(^[A-Z]{2}[0-9]{2}[A-Z]{3}$)|(^[A-Z][0-9]{1,3}[A-Z]{3}$)|(^[A-Z]{3}[0-9]{1,3}[A-Z]$)|(^[0-9]{1,4}[A-Z]{1,2}$)|(^[0-9]{1,3}[A-Z]{1,3}$)|(^[A-Z]{1,2}[0-9]{1,4}$)|(^[A-Z]{1,3} [0-9]{1,3}$)/'],
        ]);


        // create new curl instance
        $ch = curl_init();

        // set the options
        curl_setopt($ch, CURLOPT_URL, 'https://beta.check-mot.service.gov.uk/trade/vehicles/mot-tests?registration=' . $validatedData['registration']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json+v6',
            'x-api-key: GNTz421ZAi5ZiYRbhGHKAepPwVxvQGK8gP9A6zb5'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // execute the request
        $result = curl_exec($ch);

        // get the http status code
        $responseStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        $result = json_decode($result);

        // response()->json({some:"json_data"}, 404 / 200 / etc)
        return response()->json($result, $responseStatus);
    }
}
