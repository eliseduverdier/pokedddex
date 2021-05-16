<?php

declare(strict_types=1);

namespace App\Tests\Functional\Context;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

use JsonSchema\Validator;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class RequestContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When I send a request to :path
     */
    public function iSendARequestTo(string $path): void
    {
        $this->response = $this->kernel->handle(Request::create($path, 'GET'));
    }

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived(): void
    {
        if ($this->response === null) {
            throw new \RuntimeException('No response received');
        }
    }

    /**
     * @Then the response status code should be :status
     */
    public function theResponseStatusCodeShouldBe(int $status): void
    {
        if ($this->response->getStatusCode() !== $status) {
            throw new \UnexpectedValueException("Expected status $status, but got {$this->response->getStatusCode()}");
        }
    }

    /**
     * @Then the response content type should be :contentType
     */
    public function theResponseContentTypeShouldBe(string $contentType): void
    {
        $this->theResponseHeaderShouldBe('content-type', $contentType);
    }

    /**
     * @Then the status code should be :status
     */
    private function theResponseHeaderShouldBe(string $name, string $value): void
    {
        $headerValue = $this->response->headers->get($name);
        if ($headerValue !== $value) {
            throw new \UnexpectedValueException("Expected header $name: $value but got $headerValue");
        }
    }

    /**
     * @Then prints the response
     */
    public function printsTheResponse(): void
    {
        dump($this->response->getContent() ?? null);
    }

    /**
     * @Then validates the Schema for :type
     */
    public function validatesSchema(string $type): void
    {
        try {
            $jsonSchemaObject = json_decode(
                file_get_contents(dirname(__DIR__, 3) . "/resources/schema/$type.json")
            );
        } catch (\Exception $e) {
            throw new \Exception("Schema /resources/schema/$type.json does not exist");
        }
        $apiResponseData = json_decode($this->response->getContent());

        $validator = new Validator();
        $validator->validate(
            $apiResponseData,
            $jsonSchemaObject
        );

        if (!$validator->isValid()) {
            $errors = [];
            foreach ($validator->getErrors() as $error) {
                $errors[] = sprintf("[%s] %s", $error['property'], $error['message']);
            }
            throw new \UnexpectedValueException(
                'JSON does not validate. Violations: '
                    . "\n"
                    . implode("\n", $errors)
            );
        }
    }
}
