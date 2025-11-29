<?php

require_once './app/utils/Render.php';
require_once './app/models/ActiviteModel.php';
/*require_once './app/models/ReservationModel.php'; */

class ActiviteController
{
    use Render;

    /*Affiche ttes les activités*/
    public function index(): void
    {
        $model = new ActiviteModel();
        $activites = $model->getAllActivities();

        $data = [
            'title'     => 'Liste des activités',
            'activites' => $activites,
            'isAdmin'   => ($_SESSION['role'] ?? '') === 'admin'
        ];

        $this->renderView('activite/all', $data);
    }

    /* Affiche une activité + formulaire de résa
     * Si admin → btons update + delete*/
    public function show(int $id): void
    {
        $model = new ActiviteModel();
        $activite = $model->getActivityById($id);

        if (!$activite) {
            die("Activité introuvable.");
        }

        $data = [
            'title'     => "Activité #{$id}",
            'activite'  => $activite,
            'isAdmin'   => ($_SESSION['role'] ?? '') === 'admin'
        ];

        $this->renderView('activite/one', $data);
    }

    /* Edition d’une activité (ADMIN seulement)*/
    public function update(int $id, array $dataForm = []): void
    {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            die("Accès refusé.");
        }

        $model = new ActiviteModel();

        // Si get → afficher le form
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $activite = $model->getActivityById($id);

            $data = [
                'title'    => 'Modifier une activité',
                'activite' => $activite
            ];

            $this->renderView('activite/update', $data);
            return;
        }

        // Sinon → traitement POST
        $model->update($id, $dataForm);

        header("Location: /activity/show/$id");
        exit();
    }

    /*Suppression d’une activité (ADMIN)*/
    public function delete(int $id): void
    {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            die("Accès refusé.");
        }

        $reservationModel = new ReservationModel();
        $activiteModel = new ActiviteModel();

       
        // Supprimer l’activité
        $activiteModel->delete($id);

        header("Location: /activite");
        exit();
    }
}
