<?php

class ActiviteModel extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Récupère ttes les activités
     */
    public function getAllActivities(): array
    {
        $stmt = $this->co->prepare('SELECT * FROM activities');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    /**
     * Récupère une activité par son ID
     */
    public function getActivityById(int $id): array|false
    {
        $stmt = $this->co->prepare('SELECT * FROM activities WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Calcule le nombre de places restantes pour une activités
     */
    public function getPlacesLeft(int $id): int
    {
        $stmt = $this->co->prepare('SELECT places_max, places_prises FROM activities WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$activity) {
            return 0;
        }

        // Calcul
        return (int)($activity['places_max'] - $activity['places_prises']);
    }
}
