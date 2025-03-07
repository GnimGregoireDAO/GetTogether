<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="DAO Gnim Gregoire, Sarah Laroubi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> GetTogether </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" target=_blank href="../Style/Acceuil2.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1 id="together">GetTogether</h1>
        </div>
        <nav class="nav">
            <a target=_blank href="#comment">Comment ça marche?</a>
            <a target=_blank href="#decouvrir">Découvrir</a>
            <a target=_blank href="#groupes">Groupes</a>
            <a target=_blank href="#footer">Nous contacter</a>
            <a target=_blank href="connexion.php">
                <button class="button">Se connecter</button>
            </a>
        </nav>
    </header>
    <main class="main container mt-5">
        <div class="row">
            <div class="col-md-6 section_gauche">
                <h1>Gérer vos activités de groupe <br>gratuitement !</h1><br>
                <p>Notre interface intuitive et ses fonctionnalités collaboratives visent à renforcer vos liens<br> d'amitié, les renouer et à faciliter l'organisation de vos moments mémorables.
                    <br><i>"Les amis sont la famille que nous choisissons pour nous-mêmes."- Edna Buchanan</i></p>
                <a target=_blank href="CreerCompte.php">
                    <button class="bouton_inscription btn btn-primary">Je m'inscris !</button>
                </a>
            </div>
            <div class="col-md-6 section_droite">
                <img src="../images/groupeCat.JPG" alt="Bannière" class="image img-fluid">
            </div>
        </div>
    </main>
    <section id="decouvrir" class="container mt-5">
        <h2>Découvrir</h2>
        <p>Bienvenue sur notre site de gestion d'activités de groupe (MGSE). Vous prévoyez de vous retrouver avec vos amis après une très longue période
        dans un bar ou encore juste vous rassemblez à nouveau autour d'un repas chaud à la maison., allez faire du foot, allez au billard. Alors notre
        application est parfaite pour organiser votre rendez-vous. Grâce à cette application, vous pourrez facilement créer des groupes,
        planifier des activités, inviter des amis, et suivre les événements à venir. </p>
    </section>
    <section id="groupes" class="container mt-5">
        <h2>Groupes</h2>
        <div class="row">
            <div class="col-md-3 group-box">
                <h3>Groupe de Soccer</h3>
                <p>Rejoignez notre groupe de soccer pour des matchs amicaux chaque semaine.</p>
            </div>
            <div class="col-md-3 group-box">
                <h3>Les Skieurs de l'extrême</h3>
                <p>Venez dévaler les pistes avec les skieurs les plus passionnés.</p>
            </div>
            <div class="col-md-3 group-box">
                <h3>Groupe de cuisine Italienne</h3>
                <p>Découvrez les secrets de la cuisine italienne avec notre groupe de passionnés.</p>
            </div>
            <div class="col-md-3 group-box">
                <h3>Groupe de danse salsa</h3>
                <p>Apprenez et pratiquez la salsa avec des danseurs de tous niveaux.</p>
            </div>
        </div>
    </section>
    <section id="comment" class="container mt-5">
        <h2>Comment Ça Marche ?</h2>
        <p>Créez des activités pour vos groupes.
        Vous pouvez ajouter des détails tels que la date, l'heure, le lieu et une description.
        Vous pouvez également inviter des amis à participer à l'activité. </p>
    </section>
    <footer id="footer" class="container mt-5">
        <h1>Nos Coordonnées</h1>
        <p>MGSE PRODUCTIONS
        Adresse: 1597 rue Saint michel <br>
        Ville: Montréal<br>
        Province: Québec<br>
        Code Postal: J6W3J1<br>
        Téléphone: 438 282 9977<br>
        Mail: daogregoire09@gmail.com</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.group-box').hover(function() {
                $(this).css('background-color', '#f0f0f0');
                $(this).animate({
                    marginTop: "-=10px"
                }, 200);
            }, function() {
                $(this).css('background-color', '#fff');
                $(this).animate({
                    marginTop: "0px"
                }, 200);
            });
        });
    </script>
</body>
</html>