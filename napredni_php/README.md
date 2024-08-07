### Zadaca preko praznika

#### 07.08.2024
##### Demo aplikaciju mozete pogledati na [ovom](https://algebra.adicio.hr/) linku

#### 30.07.2024

##### Zadaci su poredani po tezini IMO. Stoga nastojte rjesavati od prvog prema posljednjem buletu.

* u genres/show dodati listu filmova koji spadaju u taj zanr [Prikaz](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/genre-show.PNG)
* dodati CRUD funkcionalnost za medije i cjenik [Hint](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/views/partials/sidebar.php)
* zavrsiti CRUD za filmove -> dodati show, update i delete (kod Delete podesiti bazu na ON DELETE CASCADE da se povezane kopije obrisu automatski)
* za movies/create -> movies/store dodati dodavanje kopija u istom POST requestu [Prikaz](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/movie-create.PNG)
* napraviti dashboard na ruti /dashboard u kontroleru dashboard/index.php kolji pokazuje tablicu aktivnih posudbi i mogucnost brzog kreiranja nove posudbe [Prikaz](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/dashboard.PNG)
* napraviti CRUD za posudbe -> stvara zapis u tablicama 'posudba' i 'kopija_posudba'
    - rentals/index [Slicno kao drugi dio dashboarda](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/dashboard.PNG)
    - rentals/show  [Prikaz](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/rental-show.PNG)  [Hint-1](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/rentals-show-hint.md)  [Hint-2](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/dohvacanje_pojedine_posudbe.md)
    - rentals/create  [Slicno kao prvi dio dashboarda](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/hints/dashboard.PNG)
    - rentals/return  Hint: pritiskom na gumb Vrati na dashboardu [Hint](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/Controllers/rentals/destroy.php)
* rentals/edit - IMO nije potreban ali ako pokusate napraviti mozete nesto novo nauciti [Hint](https://github.com/adobrini-algebra/backend_developer_0/tree/main/napredni_php/Controllers/rentals/destroy.php)
