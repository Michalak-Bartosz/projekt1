Aplikacja Tripline umożliwia tworzenie pamiętnika z podróży w postaci osi czasu, na którą zostają nanoszone dodane przez użytkownika wydarzenia.

![image](https://github.com/Michalak-Bartosz/projekt1/assets/75935150/da549d5a-ba49-48dc-bc46-398b3bd2ef08)

Tripline została napisana w opraciu o język programowania PHP wraz z frameworkiem Symfony oraz Tailwind CSS.

--------------------------------------------------------------------------------------------------------------------------------------------------

Aplikacja jest dostępna pod adresem: http://89.168.82.33:8080/events

--------------------------------------------------------------------------------------------------------------------------------------------------

W celu uruchomienia aplikacji lokalnie należy posiadać:

-> node.js: https://nodejs.org/en/download

-> composer: https://getcomposer.org/download/

Po sklonowaniu repozytorium, w katalogu projektu należy uruchomić komendy:
````
composer install
npm install
symfony server:start
````
Aplikacja domyślnie uruchamia się pod adresem:

http://127.0.0.1:8000/events

W celu zmiany portu ostatnią komendę należy rozszerzyć o flagę --port w następujący sposób:
````
symfony server:start --port=<wybrany_numer_portu>
````
