# Note de conception

## 1. Choix principaux

On a premierement porter notre attention sur BookingService.php qui est le document maitre de se projet, on a pu remarquer quelquer erreurs, comme par exemple de la répétition ou encore des if, elseif, else qui pouvaient etre simplifier en quelques lignes ou améliorer. 
Pour résoudre se probleme de if, on a prit la décision de passer par une interface pour pouvoir gérer les type de paiement diverse depuis laquelle on peut etre rediriger vers le mode de paiement désirer sans que cela prenne de place dans le BookingService.php. 
Cette modification a pu permetre que si il y avait une erreur dans le paiement, BookingService.php crash tout et qu'il y ai seulement un probleme dans le paiement.
On a aussi créer un dossier qui gère tout les observeurs qui servent que tout fonctionne correctement.


## 2. Principes SOLID mobilisés

Pour chaque principe réellement utilisé :
- problème initial ;
- classes concernées ;
- bénéfice obtenu.

DEPENDENCY INVERSION PRINCIPLE:
- Plusieurs class était appeler dans le fichier maitre du projet, se qui n'est pas une bonne pratique ;
- BookingService, PayGateway, StripeAdapter, PayFastAdapter, PayFastSdk et StripeClient ;
- une interface qui permet de gérer plus facilement les paiements sans bloquer et une meilleur compréhension de se qui se passe.

OPEN / CLOSED PRINCIPLE:
- Pour le ticket 104, on devait faire 4 différentes actions, apèes décisions nous avons choisi de les séparer en 4 différentes class ;
- AnalysticsClientObserver, BookingConfirmed, EmailConfirmationObserver, LoyaltyPointObserver, SmsClientObserver ;
- Une claireter de compréhension, une aération de class et une facilité d'utilisation.

## 3. Design Patterns éventuellement utilisés

Pour chaque pattern :
- problème rencontré ;
- solution retenue ;
- pourquoi une solution plus simple ne suffisait pas.

Si aucun pattern n'est utilisé sur une partie du projet, expliquez pourquoi.

Stratégie:
- Plusieurs class était appeler dans le fichier maitre du projet, se qui n'est pas une bonne pratique ;
- Créer un interface pour pouvoir dispercer les différents moyen de payer ;
- Car la classe dans laquel c'était a l'origine était trop charger, elle faisait trop de chose.

Simple Factory:
- Pour le ticket 104, on devait faire 4 différentes actions ;
- Créer 4 différentes class pour les traiter ;
- .

## 4. Solutions envisagées puis écartées

À compléter.

## 5. Ce que nous améliorerions avec plus de temps

La charge que BookinService à, la class est toujours trop chargé se qui peut posé des problèmes dans le futur
