<?php
class MyStats {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }
    /**
     * Enregistre les glossaires statistiques dans la base de données.
     *
     * @param array $stats Les glossaire statistiques à enregistrer.
     * @param string $inrow La clé pour accéder aux statistiques spécifiques dans le tableau.
     * @param string $intitule Le libellé à utiliser pour les statistiques.
     * @param int $idexp L'ID de l'expression associé aux statistiques.
     * @return void
     */
    public function savestats($stats, $inrow, $intitule, $idexp) {
        $statistics = $stats[$inrow];
        $stmt = $this->mysqli->prepare("INSERT INTO textstats (id_expw, word, typestat) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $this->mysqli->error);
            return;
        }
        $idexpww = "3";
        foreach ($statistics as $word) {
            $stmt->bind_param("iss", $idexp, $word, $intitule);
            $stmt->execute();
        }
        $stmt->close();
    }

    /**
     * Enregistre les statistiques dans la base de données.
     *
     * @param array $stats Les statistiques en nombre à enregistrer.
     * @param string $inrow La clé pour accéder aux statistiques spécifiques dans le tableau.
     * @param string $intitule Le libellé à utiliser pour les statistiques.
     * @param int $idexp L'ID de l'expression associé aux statistiques.
     * @return void
     */
    public function nbstats($stats, $inrow, $intitule, $idexp) {
        global $mysqli; // Assurez-vous que $mysqli est accessible dans la portée de la fonction
        $statistics = $stats[$inrow];
        $stmt = $mysqli->prepare("INSERT INTO textstats (id_expw, word, typestat) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $mysqli->error);
            return;
        }
        mysqli_stmt_bind_param($stmt, "iss", $idexp, $statistics, $intitule);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>
