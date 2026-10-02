# Audit initial

## 1. Comportement observable

L'application va calculer le payment que l'utilisateur devra payer avec la méthode de payment.
Ajout dans la base de donnée l'id du ticket, le prix et la confirmation de la reservation.
Relier  l'email de l'utilisateur avec avec le ticket
Renvoie le prix final du ticket.

## 2. Problèmes identifiés

| # | Problème | Catégorie | Impact |
|---|---|---|---|
| 1 | Booking Service : Nombre magique| lisibilité | Important |
| 2 | Booking Service : trop de responsabilité | Strucutre / Responsabilité | Très impportant |
| 3 | Booking Service : Plusieurs if dans une classe | Structure / Couplage | Important |
| 4 | Booking Service : Dépendance avec d'autres classes (StripeClient, EmailService) | Couplage | Critique |
| 5 | Pas de garde-fou pour le numéro du client | règles métier | Important |
| 6 | Strip Client : Nom de fonction pas assez explicite | Lisibilité | Peu important |

## 3. Nos trois priorités

1. Trop de responsabilité dans Booking Service -> compréhension du document plus difficile, risque d'impacter les autres partis en cas de pproblème.
2. Dépendance avec d'autres classes, -> une modification ou un problème dans une dépendance peut affecter BookingService
3. Accumulation de conditions -> La classe devient plus complexe et chaque nouveau comportement nécessite de modifier la classe.

## 4. Risques avant refactoring


