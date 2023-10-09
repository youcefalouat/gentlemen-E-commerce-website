<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


   
    public function getChartData()
{
    $labels = [
        'Commandé',
        "Confirmé",
        'Livrés à la sociéte',
        'Livrés au client',
        'Retour',
        'Annuler',
    ];

    $etats = Order::select('status', DB::raw('COUNT(*) as count'))
    ->groupBy('status')
    ->get();

    // Create an array to store the result
    $results = [];

    // Iterate through each "secteur" and assign the count to the result array
    foreach ($etats as $etat) {
        $results[$etat->status] = $etat->count;
    }

    return [
        'labels' => $labels,
        'datasets' => $results,
    ];
}

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function getChartDataPeriod(Request $request)
    {
        // Get the start and end date parameters from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Define your labels for the chart
        $labels = [
            'Commandé',
            "Confirmé",
            'Livrés à la sociéte',
            'Livrés au client',
            'Retour',
            'Annuler',
        ];
    
        // Query the orders table with date filters
        $etats = Order::whereBetween('updated_at', [$startDate, $endDate])
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
    
        // Create an array to store the result
        $results = [];
    
        // Iterate through each "status" and assign the count to the result array
        foreach ($etats as $etat) {
            $results[$etat->status] = $etat->count;
        }
    
        return [
            'labels' => $labels,
            'datasets' => $results,
        ];
    }
    



}
