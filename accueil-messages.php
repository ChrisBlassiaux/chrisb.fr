<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Chris - Messages </title>
		<link rel="stylesheet" href="style.css">
		<link rel="shortcut icon" href="img/icons.png" type="image/png"/>

		<!-- FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
	
		
	</head>
	<body>
		<!-- TOP BAR + NAV 1  -->
		<header class="topbar">
			<a href="accueil-profil.html" class="topbar-logo"><h1>Chris</h1> </a>
			<nav class="topbar-nav">
				<a href="#" class="home active1">Accueil</a>
				<a href="web.html" class="web">Web</a>
				<a href="arts.html" class="arts">Arts</a>
				<a href="books.html" class="books">Books</a>
			</nav>
		</header>
		<!-- CONTAINER  -->
		<div class="container site">
			<!-- NAV 2 SOCIAL -->
            <nav class="sidebar">
				<a href="accueil-profil.html" class="sidebar-profil">Mon Profil</a>
				<a href="index.html" class="sidebar-home">Fil d'actualité</a>
				<a href="accueil-events.html" class="sidebar-events">Evènements</a>
				<a href="#" class="sidebar-messages">Messages</a>
			</nav>
			<!-- MIDDLE -->
			<main class="main">
				<!--  MAIN -->
				<article class="card card-messages">
					
						
					<header class="card-header card-header-avatar">
						<img src="img/avatar.png" width="45" height="45" alt="" class="card-avatar">
						<div class="card-title">
										Chris 
							</div>
							<div class="card-time">
										Contacte moi !
							</div>
							</header>
							<div class="card-body card-body-messages">

								<!-- MES MESAGES  -->
								<p class="message-1">Salut, tu souhaites me<br> contacter ? </p><br>
								<p class="message-2">Tu peux m'envoyer un email <br>à l'adresse email suivante : 	<a href="mailto:chrisblassiaux@gmail.com" class="mailto">chrisblassiaux@gmail.com</a> </p>
									<br><br>
						


<!-- MESSAGE USER -->

								<form method="post" action="<?php echo strip_tags($_SERVER['REQUEST_URI']); ?>" class="messages-form">
									<div class="form-example">
										<!-- Nom -->
										<label for="nom">Nom : </label> 
										<br>
										<input type="text" name="nom" id="nom" required class="cases-messages">
									</div>
										
									<br>
									<div class="form-example">
										<!-- Email -->
										<label for="email"> Email : </label>
										<br>
										<input type="text" name="email" id="email" required class="cases-messages">
										</div>
									<br>

										<!-- Son message -->
										<label for="message">Message :</label>
										<br>
										<textarea name="message" id="" class="cases-messages case-textarea"></textarea>
										<!-- Bouton d'envoi -->
										<p>Combien font 1+3: <span style="color:#ff0000;">*</span>: <input type="text" name="captcha" size="2" /></p>
									
										<p><input type="submit" name="submit" value="Envoyer" class="button-messages" title="Envoyer !" /></p>
										
									</form>
								


								<?php
// S'il y des donn�es de post�es
if ($_SERVER['REQUEST_METHOD']=='POST') {
  // Code PHP pour traiter l'envoi de l'email
  
  $nombreErreur = 0; // Variable qui compte le nombre d'erreur
  
  // D�finit toutes les erreurs possibles
  if (!isset($_POST['email'])) { // Si la variable "email" du formulaire n'existe pas (il y a un probl�me)
    $nombreErreur++; // On incr�mente la variable qui compte les erreurs
    $erreur1 = '<p>Il y a un problème avec la variable "email".</p>';
  } else { // Sinon, cela signifie que la variable existe (c'est normal)
    if (empty($_POST['email'])) { // Si la variable est vide
      $nombreErreur++; // On incr�mente la variable qui compte les erreurs
      $erreur2 = '<p>Vous avez oublie de donner votre email.</p>';
    } else {
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $nombreErreur++; // On incr�mente la variable qui compte les erreurs
        $erreur3 = '<p>Cet email ne ressemble pas un email.</p>';
      }
    }
  }
  
  if (!isset($_POST['message'])) {
    $nombreErreur++;
    $erreur4 = '<p>Il y a un problème avec la variable "message".</p>';
  } else {
    if (empty($_POST['message'])) {
      $nombreErreur++;
      $erreur5 = '<p>Vous avez oublie de donner un message.</p>';
    }
  }
  
  if (!isset($_POST['captcha'])) {
    $nombreErreur++;
    $erreur6 = '<p>Il y a un problème avec la variable "captcha".</p>';
  } else {
    if ($_POST['captcha']!=4) {
      $nombreErreur++;
      $erreur7 = '<p>Désolé, le captcha anti-spam est erroné.</p>';
    }
  }
  
  if ($nombreErreur==0) { // S'il n'y a pas d'erreur
    // R�cup�ration des variables et s�curisation des donn�es
    $nom = htmlentities($_POST['nom']); // htmlentities() convertit des caract�res "sp�ciaux" en �quivalent HTML
    $email = htmlentities($_POST['email']);
    $message = htmlentities($_POST['message']);
    
    // Variables concernant l'email
    $destinataire = 'chrisblassiaux@gmail.com'; // Adresse email du webmaster
    $sujet = 'Titre du message'; // Titre de l'email
    $contenu = '<html><head><title>Titre du message</title></head><body>';
    $contenu .= '<p>Bonjour, vous avez reçu un message à partir de votre site web.</p>';
    $contenu .= '<p><strong>Nom</strong>: '.$nom.'</p>';
    $contenu .= '<p><strong>Email</strong>: '.$email.'</p>';
    $contenu .= '<p><strong>Message</strong>: '.$message.'</p>';
    $contenu .= '</body></html>'; // Contenu du message de l'email
    
    // Pour envoyer un email HTML, l'en-t�te Content-type doit �tre d�fini
    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    
    @mail($destinataire, $sujet, $contenu, $headers); // Fonction principale qui envoi l'email
    
    echo '<h2 style="color: red; background-color: #5686DA; text-align: right; padding: 5px; border-radius: 10px; display: inline-block; margin-top: 10px; position: relative; margin-left: 10px;  ">Message envoyé !</h2>'; // Afficher un message pour indiquer que le message a �t� envoy�
  } else { // S'il y a un moins une erreur
    echo '<div style="border:1px solid red; padding:5px; margin: 5px; border-radius: 10px;">';
    echo '<p style="color:red;">Désolé, il y a eu '.$nombreErreur.' erreur(s). Voici le détail des erreurs:</p>';
    if (isset($erreur1)) echo '<p>'.$erreur1.'</p>';
    if (isset($erreur2)) echo '<p>'.$erreur2.'</p>';
    if (isset($erreur3)) echo '<p>'.$erreur3.'</p>';
    if (isset($erreur4)) echo '<p>'.$erreur4.'</p>';
    if (isset($erreur5)) echo '<p>'.$erreur5.'</p>';
	if (isset($erreur6)) echo '<p>'.$erreur6.'</p>';
	if (isset($erreur7)) echo '<p>'.$erreur7.'</p>';
    echo '</div>';
  }
}
?>		  
			
							</div>	
				</article>	
            </main> 


			<aside class="aside">

				<!-- MINI PROFIL -->
                <!-- Utilisation des articles dans le main -->
             <a href="accueil-profil.html">
				<article class="card profil">
							<!-- Header  -->
					<header class="card-header card-header-avatar">
						<img src="img/avatar.png" width="45" height="45" alt="" class="card-avatar">
						<div class="card-title">
									Chris
						</div>
						<div class="card-time">
									Inscrit il y a 1 semaine
						</div>
					</header>
							<!-- Body -->
					<div class="card-body">
						<p>
							Salut ! Moi c'est Chris, je suis ancien étudiant en communication visuelle, actuellement en formation de développement web, passionné par la Technologie, le Développement Web, le Design et l'Art.  
						</p>	
					</div>
				</article>
            </a>


				<!-- SUGGESTION  -->
				<!-- TITRE RUBRIQUE SUGGESTION -->
				<div class="sugg-title">Sugggestion</div>
				<!-- LA LISTE -->
				<div class="sugg-list">
					<!-- Premier site  -->
					<div class="sugg-site">
							<a href="https://cercle-chromatique.000webhostapp.com/" target="_blank"><img src="img/sugg/sugg-chroma.jpg" class="sugg-avatar" alt="cercle chromatique"></a>
							<div class="sugg-body">
								<a href="https://cercle-chromatique.000webhostapp.com/" target="_blank"><div class="sugg-name">Cercle Chromatique</div></a>
								<div class="sugg-description">Article entrainement</div>
							</div>
						</div>
						<!-- 2eme site  -->
						<div class="sugg-site">
								<a href="https://carbonyl-tables.000webhostapp.com/" target="_blank"><img src="img/sugg/sugg-domi.jpg" class="sugg-avatar" alt="logo Dominator Festival"></a>
								<div class="sugg-body">
									<a href="https://carbonyl-tables.000webhostapp.com/" target="_blank"><div class="sugg-name">Dominator Festival</div></a>
									<div class="sugg-description">Site entrainement</div>
								</div>
						</div>
					<!-- 3eme site  -->
				
				</div>
				


			</aside>
		</div>
</body>
</html>