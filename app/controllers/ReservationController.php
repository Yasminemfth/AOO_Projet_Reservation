<?php 
require_once './app/models/ActiviteModel.php';
require_once './app/utils/Render.php';
require_once './app/models/ReservationModel.php';
require_once './app/utils/Auth.php';

class ReservationController {
    use Render;
    use Auth;

    /* affiche toutes les réservations */
    public function findAll(): void
    {
         $this->requireAdmin();
        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->getAllReservations();

        $data = [
            'title' => 'Liste des réservations',
            'reservations' => $reservations
        ];

        $this->renderView('reservation/all', $data);
    }

    /* affiche les réservations d'un utilisateur */
public function findOneById(int $id): void
{
    $reservationModel = new ReservationModel();
    $reservations = $reservationModel->getReservationsByUserId($id);

    $data = [
        'title' => 'Mes réservations',
        'reservations' => $reservations
    ];

    $this->renderView('reservation/one', $data);
}

    /* form pour ajouter une résa */
   public function inserer(int $activityId = null): void
{
    $reservationModel = new ReservationModel();
    $activiteModel = new ActiviteModel(); // ← OBLIGATOIRE !

    //  afficher le formulaire
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

      $activite = $activiteModel->getActivityById($activityId);
        $data = [
            'title' => 'Ajouter une réservation',
            'activityId' => $activityId,
            'activityName' => $activite['name'] ?? "Activité inconnue",
        ];

        $this->renderView('reservation/inserer', $data);
        return;
    }

    // traitement
    $userId = $_SESSION['id'] ?? null;
    $activityId = $_POST['activityId'] ?? null;
    

    if (empty($userId) || empty($activityId)) {
        $data = [
            'title' => 'Ajouter une réservation',
            'error' => 'Champs vides',
            'activityId' => $activityId
        ];
        $this->renderView('reservation/inserer', $data);
        return;
    }

    // vérification des places restantes
    $activite = $activiteModel->getActivityById($activityId);

    if (!$activite) {
        $data['error'] = "Activité introuvable.";
        $this->renderView('reservation/inserer', $data);
        return;
    }

    if ($activite['seatsLeft'] <= 0) {
        $data['error'] = "Cette activité est complète.";
        $this->renderView('reservation/inserer', $data);
        return;
    }

    // enregistrer la résa
    $reservationModel->createReservation($userId, $activityId);

    // enlever les places
    $activiteModel->decreaseSeats($activityId);

    header("Location: /reservation/findOneById/$userId");
    exit();
}

    /* annule une réservation */
    public function enleverReservation(int $reservationId): void
    {
        $reservationModel = new ReservationModel();

        $success = $reservationModel->cancelReservation($reservationId); // met etat = 0

        if (!$success) {
            $data = [
                'title' => 'Annuler une réservation',
                'error' => 'Échec de l’annulation'
            ];
            $this->renderView('reservation/one', $data);
            return;
        }

        $userId = $_SESSION['id'];
        header("Location: /reservation/findOneById/$userId");
        exit();
    }

}
