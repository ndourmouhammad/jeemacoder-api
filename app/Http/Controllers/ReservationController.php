<?php

namespace App\Http\Controllers;

use App\Mail\ReservationAccepted;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationNotification;
use App\Mail\ReservationRefused;
use App\Models\Reservation;
use App\Models\Installation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Créer une nouvelle reservation
    public function store(Request $request, $installation_id)
    {
        // Valider les données de la requête
        $validator = validator($request->all(), [
            'date' => 'required|date|after_or_equal:today',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        ]);

        // Vérifier si la validation a échoué
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation échouée.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Récupérer les données validées
        $validated = $validator->validated();

        // Vérifier si l'installation existe
        $installation = Installation::find($installation_id);
        if (!$installation) {
            return response()->json([
                'status' => false,
                'message' => 'Installation non trouvée.',
            ], 404);
        }

        // Vérifier la disponibilité pour ce créneau
        $exists = Reservation::where('installation_id', $installation_id)
            ->where('date', $validated['date'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('heure_debut', [$validated['heure_debut'], $validated['heure_fin']])
                    ->orWhereBetween('heure_fin', [$validated['heure_debut'], $validated['heure_fin']]);
            })
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Ce créneau est déjà réservé.',
            ], 400);
        }

        // Calculer la durée en heures
        $heureDebut = strtotime($validated['heure_debut']);
        $heureFin = strtotime($validated['heure_fin']);
        $dureeEnHeures = ($heureFin - $heureDebut) / 3600;

        // Calculer le coût total
        $prixTotal = $dureeEnHeures * $installation->prix_par_heure;

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'installation_id' => $installation_id,
            'date' => $validated['date'],
            'heure_debut' => $validated['heure_debut'],
            'heure_fin' => $validated['heure_fin'],
            'statut' => 'en_attente',
            'prix_total' => $prixTotal, // Enregistrer le coût total
        ]);

        // Envoyer une notification par email
        Mail::to($reservation->user->email)->send(new ReservationNotification($reservation));

        return response()->json([
            'status' => true,
            'message' => 'Réservation créée avec succès.',
            'data' => $reservation,
        ], 201);
    }


    // Confirmer une réservation
    public function confirm($id)
    {
        // Récupérer la réservation
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Réservation non trouvée.',
            ], 404);
        }

        // Vérifier si la réservation est déjà confirmée
        if ($reservation->statut === 'confirmee') {
            return response()->json([
                'status' => false,
                'message' => 'Cette réservation est déjà confirmée.',
            ], 400);
        }

        // Confirmer la réservation
        $reservation->statut = 'confirmee';
        $reservation->save();

        // Envoyer une notification par email
        Mail::to($reservation->user->email)->send(new ReservationAccepted($reservation));

        return response()->json([
            'status' => true,
            'message' => 'Réservation confirmée avec succès.',
            'data' => $reservation,
        ], 200);
    }

    // Annuler une reservation
    public function cancel($id)
    {
        // Récupérer la réservation
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json([
                'status' => false,
                'message' => 'Réservation non trouvée.',
            ], 404);
        }

        // Vérifier si la réservation est déjà annulée
        if ($reservation->statut === 'annulee') {
            return response()->json([
                'status' => false,
                'message' => 'Cette réservation est déjà annulée.',
            ], 400);
        }

        // Annuler la réservation
        $reservation->statut = 'annulee';
        $reservation->save();

        // Envoyer une notification par email
        Mail::to($reservation->user->email)->send(new ReservationRefused($reservation));

        return response()->json([
            'status' => true,
            'message' => 'Réservation annulée avec succès.',
            'data' => $reservation,
        ], 200);
    }

    // Voir mes reservations
    public function myReservations()
{
    // Récupérer les réservations de l'utilisateur connecté avec les informations de l'installation
    $reservations = auth()->user()->reservations()->with('installation')->get();

    return response()->json([
        'status' => true,
        'message' => 'Mes réservations avec les installations.',
        'data' => $reservations,
    ], 200);
}


    // Lister toutes les reservations
    public function reservations()
    {
        $reservations = Reservation::with('installation', 'user')->get();;

        return response()->json([
            'status' => true,
            'message' => 'Liste des reservations :',
            'data' => $reservations
        ], 200);
    }
}
