<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectGallery;
use App\Models\TrustedClient;

class ProjectController extends Controller
{
    public function index()
    {
        // Get projects from database
        $projectGalleries = ProjectGallery::active()->orderBy('year', 'desc')->get();
        
        // Transform database data to match the view format
        $projects = $projectGalleries->map(function ($gallery) {
            return [
                'id' => $gallery->id,
                'title' => "Proyek {$gallery->category} - {$gallery->client}",
                'client' => $gallery->client,
                'category' => $gallery->category,
                'year' => $gallery->year,
                'description' => $gallery->description,
                'gallery' => is_string($gallery->images) ? (json_decode($gallery->images, true) ?? []) : ($gallery->images ?? [])
            ];
        });

        // Get trusted clients from database
        $trustedClients = TrustedClient::active()->orderBy('hospital_name')->get();

        return view('projects', compact('projects', 'trustedClients'));
    }
}
