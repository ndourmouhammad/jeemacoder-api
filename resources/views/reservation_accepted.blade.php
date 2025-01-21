<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: green;
        }
        p {
            color: #555555;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Votre Réservation est Confirmée</h1>
        <p>Bonjour {{ $reservation->user->name }},</p>
        <p>Nous avons le plaisir de vous informer que votre réservation a été confirmée.</p>
        <p>Veuillez trouver ci-dessous les détails de votre réservation :</p>
        <ul>
            <li><strong>Date</strong> {{ $reservation->date }}</li>
            <li><strong>Heure de fin :</strong> {{ $reservation->heure_debut }}</li>
            <li><strong>Heure de fin :</strong> {{ $reservation->heure_fin }}</li>
            <li><strong>Prix :</strong> {{ $reservation->prix_total }} FCFA</li>
        </ul>
        <p>Si vous avez des questions ou des besoins particuliers, n'hésitez pas à nous contacter.</p>
        <p>Merci de votre confiance.</p>

        <div class="footer">
            <p>Game Zone 221 &copy; 2025</p>
        </div>
    </div>
</body>
</html>
