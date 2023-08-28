# UnoCounter
webpage to take count of the points while playing UNO, it can be used mostly for any game 

###Database schema### 

Jugadores table:
| name  | Type  | attributes |
|:-------------:|:---------------:|:-------------:|
| id       | int(11)       | auto_increment primary        |
| nombre         | varchar(255)       |         |

Puntuaciones table:

| name  | Type  |
|:-------------:|:---------------:|
| jugadorid       | int(11)       |      
| puntos         | int(11)       |         
