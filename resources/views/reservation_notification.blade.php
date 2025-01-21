<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation en Cours de Traitement</title>
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
            color: #333333;
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
        <h1>Réservation en Cours de Traitement</h1>
        <p>Bonjour {{ $reservation->user->name }},</p>
        <p>Nous vous informons que votre réservation a bien été prise en compte.</p>
        <p>Votre réservation est actuellement en cours de traitement. Vous recevrez une notification dès que son statut évoluera.</p>
        <p>Merci de votre patience et de votre confiance.</p>

        <div class="footer">
            <p>Game Zone 221 &copy; 2025</p>
        </div>
    </div>
</body>
</html>
