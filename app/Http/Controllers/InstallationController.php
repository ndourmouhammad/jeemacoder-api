<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstallationRequest;
use App\Http\Requests\UpdateInstallationRequest;
use App\Models\Installation;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $installations = Installation::all();
        return response()->json([
            'status' => true,
            'message' => 'Liste des installations :',
            'data' => $installations
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstallationRequest $request)
    {
        $installation = new Installation();
        $installation->fill($request->validated());
        $installation->save();
        return $this->customJsonResponse("Installation ajoutée avec success : ", $installation);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstallationRequest $request, $id)
    {
        $installation = Installation::find($id);
        if (!$installation) {
            return $this->customJsonResponse("Installation non trouvée ", null, 404);
        }
        $installation->fill($request->validated());
        $installation->update();
        return $this->customJsonResponse("Installation modifiée avec succès : ", $installation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $installation = Installation::find($id);
        if (!$installation) {
            return $this->customJsonResponse("Installation non trouvée ", null, 404);
        }
        $installation->delete();
        return $this->customJsonResponse("Installation supprimée avec succès : ", $installation);
    }

    
    /**
     * Lister uniquement les installations disponibles.
     */
    public function getAvailableInstallations()
    {
        $installations = Installation::where('disponible', true)->get();

        return response()->json([
            'status' => true,
            'message' => 'Liste des installations disponibles :',
            'data' => $installations
        ], 200);
    }

    public function setDisponibilite(Request $request, $id)
{
    $status = $request->input('status');
    if (!is_bool($status)) {
        return $this->customJsonResponse("Le statut doit être un booléen.", null, 400);
    }

    $installation = Installation::find($id);
    if (!$installation) {
        return $this->customJsonResponse("Installation non trouvée", null, 404);
    }

    $installation->disponible = $status;
    $installation->save();

    $message = $status
        ? "L'installation est maintenant disponible."
        : "L'installation est maintenant indisponible.";

    return $this->customJsonResponse($message, $installation);
}

}
