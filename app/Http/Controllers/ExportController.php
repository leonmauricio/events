<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;

class ExportController extends Controller
{
    public function create($id)
    {
    	$guests = Guest::where('event_id', $id)->get();
    	$csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
    	$csv->insertOne(\Schema::getColumnListing('guests'));
    	foreach ($guests as $guest) {
            $csv->insertOne($guest->toArray());
        }

        $csv->output('guests.csv');
    }
}
