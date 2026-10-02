# Audit initial

## 1. Comportement observable

L'application va calculer le payment que l'utilisateur devra payer avec la méthode de payment.
Ajout dans la base de donnée l'id du ticket, le prix et la confirmation de la reservation.
Relier  l'email de l'utilisateur avec avec le ticket
Renvoie le prix final du ticket.

## 2. Problèmes identifiés

Pas de garde fou pour le numéro du client
| # | Problème | Catégorie | Impact |
|---|---|---|---|
| 1 | Booking Service : Nombre magique| lisibilité |  |
| 2 | Booking Service : trop de responsabilité | Strucutre / Responsabilité |  |
| 3 | Booking Service : Accumulation de conditions | Structure / Couplage |  |
| 4 | Booking Service : Dépendance avec d'autres classes (StripeClient, EmailService) | Couplage |  |
| 5 | Pas de garde-fou pour le numéro du client | règles métier |  |
| 6 |  |  |  |

## 3. Nos trois priorités

1. Trop de responsabilité dans Booking Service -> compréhension du document plus difficile, risque d'impacter les autres partis en cas de pproblème.
2. Dépendance avec d'autres classes, -> une modification ou un problème dans une dépendance peut affecter BookingService
3. Accumulation de conditions -> La classe devient plus complexe et chaque nouveau comportement nécessite de modifier la classe.

## 4. Risques avant refactoring

À compléter.
