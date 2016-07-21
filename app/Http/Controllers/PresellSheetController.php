<?php

namespace App\Http\Controllers;

use App\PresellSheet;
use Illuminate\Http\Request;

use App\Http\Requests;

class PresellSheetController extends Controller
{
    /**
     * 
     * Show all the Presell Sheets
     * 
     */
    
    public function index()
    {

        dd('here');
        $sheets = PresellSheet::all()->paginate(10);
        
        return view('presellsheets',compact('sheets'));
    }
}
