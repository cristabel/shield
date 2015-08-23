<?php namespace Cristabel\Shield\Domain\Repository;

use Cristabel\Core\Domain\Repository\EloquentRepository;
use Cristabel\Shield\Domain\Administrator;

class UserAdministratorRepository extends EloquentRepository {

    public function __construct(Administrator $entity)
    {
        $this->entity = $entity;
    }

    public function getProfile($email)
    {
        return $this->entity->whereEmail($email)->first();
    }

}
