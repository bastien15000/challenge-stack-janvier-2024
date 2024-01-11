<?php

namespace App\Controller\API;

use App\Controller\TokenAuthenticatedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class APIController extends AbstractController implements TokenAuthenticatedController
{

    private string $ALLOWED_FORMAT = "application/json";

    public function __construct(
        private readonly ValidatorInterface $validator
    ) {
    }

    protected function handleException(\Exception $e): JsonResponse
    {
        return $this->json([
            'status' => $e->getCode(),
            'content' => $e->getMessage()
        ], 500);
    }

    protected function verifyFormatAllowed(?string $contentType): void
    {
        if ($contentType !== $this->ALLOWED_FORMAT) {
            throw new NotAcceptableHttpException('Le format n\'est pas autorisé');
        }
    }

    /**
     * @param mixed $newCompany
     * @return void
     */
    protected function verifyForm(mixed $newCompany): void
    {
        $errors = $this->validator->validate($newCompany);

        if (count($errors) > 0) {

            $errorsString = "";

            foreach ($errors as $error) {
                $errorMsg = $error->getMessage();
                $errorProperty = $error->getPropertyPath();
                $errorsString .= "$errorProperty : $errorMsg\n";
            }

            throw new BadRequestException($errorsString);
        }
    }
}
