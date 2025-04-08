<?php

namespace App\Controller;

use App\Dto\ServidorEfetivoLotadoDTO;
use App\Repository\ServidorEfetivoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServidorEfetivoController extends AbstractController
{
    public function servidoresLotados(int $unidadeId, ServidorEfetivoRepository $repository): JsonResponse
    {
        $servidores = $repository->findByUnidadeId($unidadeId);

        $efetivos =  array_map(
            function ($servidor) {
                return new ServidorEfetivoLotadoDTO(
                    $servidor->getPessoa()->getNome(),
                    $servidor->getPessoa()->getIdade(),
                    $servidor->getPessoa()->getLotacao()->getUnidade()->getNome(),
                    $servidor->getPessoa()->getFoto() ? $servidor->getPessoa()->getFoto()->getUrl() : null
                );
            },
        $servidores);

        return new JsonResponse($efetivos);
    }
}
