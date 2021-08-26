<?php
declare(strict_types=1);

namespace App\Sellers\Entrypoint\Controller;

use App\Sellers\Application\Command\Seller\Add\AddSellerCommand;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AddSellerController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function add(Request $request): JsonResponse
    {
        $body = new ParameterBag(
            \json_decode(
                $request->getContent(),
                true,
            ),
        );

        $command = AddSellerCommand::create(
            $body->get('id'),
            $body->get('name'),
            $body->get('description'),
        );

        $this->commandBus->handle($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
