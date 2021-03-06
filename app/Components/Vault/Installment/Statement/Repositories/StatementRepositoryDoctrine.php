<?php

namespace App\Components\Vault\Installment\Statement\Repositories;

use App\Components\Vault\Installment\Statement\StatementContract;
use App\Components\Vault\Installment\Statement\StatementEntity;
use App\Convention\ValueObjects\Identity\Identity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Collection;

class StatementRepositoryDoctrine implements StatementRepositoryContract
{
    /** @var EntityManagerInterface */
    private $manager;

    /** @var EntityRepository */
    private $statementsEntityRepository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager    = $manager;
        $this->statementsEntityRepository = $this->manager->getRepository(StatementEntity::class);
    }

    /**
     * @param Identity $identity
     * @return StatementContract|null
     */
    public function byIdentity(Identity $identity)
    {
        /** @var StatementEntity $entity */
        $entity = $this->statementsEntityRepository->find($identity);

        if ($entity === null) {
            throw new \Exception("Not Found Exception");
        }

        return $entity;
    }


    /**
     * @return StatementContract|null
     */
    public function getOne()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param StatementContract $statement
     * @return StatementContract
     */
    public function persist(StatementContract $statement): StatementContract
    {
        $this->manager->persist($statement);
        $this->manager->flush();
        $this->manager->clear();

        return $statement;
    }


    /**
     * @param StatementContract $statement
     * @return bool
     */
    public function destroy(StatementContract $statement): bool
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param string $key
     * @param string $operator
     * @param $value
     * @return StatementRepositoryContract
     */
    public function filter(string $key, string $operator, $value): StatementRepositoryContract
    {
        $this->mapper->where($key, $operator, $value);

        return $this;
    }
}