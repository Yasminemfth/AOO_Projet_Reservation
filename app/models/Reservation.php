<?php

class Reservation{
  private int $reservationId;
  private int $userId;
  private int $activityId;
 
  public function getId(): int
  {
    return $this->reservationId;
  }
 
  public function getUser(): int
  {
    return $this->userId;
  }
  public function getActivite (): int
  {
    return $this->activiteId;
  }
 
  public function setId(int $reservationId): self
  {
    $this->reservationId = $reservationId;
    return $this;
  }

  public function setUser(int $userId): self
  {
    $this->userId = $userId;
    return $this;
  }

  public function setActivitetId(int $activityId): self
  {
    $this->activityId = $activityId;
    return $this;
  }
}