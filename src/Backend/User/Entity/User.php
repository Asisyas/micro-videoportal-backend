<?php

namespace App\Backend\User\Entity;

use Micro\Plugin\User\Model\Doctrine\Entity\UserModel;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'User')]
class User extends UserModel
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', length: 36, nullable: false)]
    protected string $id;
}