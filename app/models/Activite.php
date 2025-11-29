<?php

class Activite
{
    private int $id;
    private int $type_id;
    private int $places_disponibles;
    private string $description;
    private DateTime $datetime_debut;
    private DateInterval $duree;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTypeId(): int
    {
        return $this->type_id;
    }

    public function setTypeId(int $type_id): self
    {
        $this->type_id = $type_id;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setPlacesDisponibles(int $places): self
    {
        $this->places_disponibles = $places;
        return $this;
    }

    public function getPlacesDisponibles(): int
    {
        return $this->places_disponibles;
    }

    public function setDatetimeDebut(DateTime $datetime_debut): self
    {
        $this->datetime_debut = $datetime_debut;
        return $this;
    }

    public function getDatetimeDebut(): DateTime
    {
        return $this->datetime_debut;
    }

    public function setDuree(DateInterval $duree): self
    {
        $this->duree = $duree;
        return $this;
    }

    public function getDuree(): DateInterval
    {
        return $this->duree;
    }
}
