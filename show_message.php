<?php 
    session_start();

    require_once("connexion_bdd/connexion.php");

    $request = $db->query("SELECT comments.commentaire, comments.date, utilisateurs.pseudo, profils.photo FROM comments INNER JOIN utilisateurs ON comments.id_utilisateur = utilisateurs.id INNER JOIN profils ON comments.id_utilisateur = profils.id_utilisateur WHERE comments.id_post = ".$_SESSION['id_post']." ORDER BY comments.date ASC");
    $comments = $request->fetchAll();

    foreach ($comments as $comment) {
        $text_time = "";
        date_default_timezone_set('Europe/Paris');
        $dateCommentaire = new DateTime($comment['date']);
        $maintenant = new DateTime();

        $diff = $maintenant->getTimestamp() - $dateCommentaire->getTimestamp();

        if ($diff < 60) {
            $text_time = $diff . ' s';
        }
        elseif ($diff < 3600) {
            $text_time =  floor($diff / 60) . ' min';
        }
        elseif ($diff < 86400) {
            $text_time =  floor($diff / 3600) . ' h';
        }
        else {
            $text_time =  floor($diff / 86400) . ' j';
        }

        echo "
            <div class=\"each_comment\">
                <div class=\"first\">
                    <div class=\"photo\">
                        <img src=\"". $comment["photo"] ."\">
                    </div>
                    <div class=\"comment\">
                        <p>". $comment["commentaire"] ."</p>
                    </div>
                </div>
                <div class=\"details\">
                    <p>". $comment["pseudo"] ."</p>
                    <p>". $text_time ."</p>
                </div>
            </div>
        ";
    }
?>