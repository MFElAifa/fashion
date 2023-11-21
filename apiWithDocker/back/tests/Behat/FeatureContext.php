<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\DataFixtures\AppFixtures;
use Behatch\HttpCall\Request;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Assert\Assertion;
use Imbo\BehatApiExtension\Context\ApiContext;

final class FeatureContext extends ApiContext
{

    public function __construct(private AppFixtures $fixtures, private EntityManagerInterface $em)
    {

    }

    /**
     * @BeforeScenario @createSchema
     */
    public function createSchema()
    {
        // Get entity metadata
        $classes = $this->em->getMetadataFactory()->getAllMetadata();

        // Drop and Create schema
        $schemaTool = new SchemaTool($this->em);
        $schemaTool->dropSchema($classes);
        $schemaTool->createSchema($classes);

        // Load fixtures
        $purger = new ORMPurger($this->em);
        $fixturesExecutor = new ORMExecutor($this->em, $purger);

        $fixturesExecutor->execute([
            $this->fixtures
        ]);
    }


    /**
     * @Then the response body is JSON
     */
    public function theResponseBodyIsJson()
    {
        $body = (string) $this->response->getBody();
        $body = json_decode($body);
        Assertion::eq(json_last_error(), JSON_ERROR_NONE);
    }
}